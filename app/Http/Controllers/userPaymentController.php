<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosUserAddresses as Addresses;
use App\vestidosTaxInfos as Tax;
use App\vestidosShippingLists as ShippingLists;
use App\vestidosOrdersProducts as OrderProducts;
use App\vestidosOrders as Orders;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Braintree_Transaction;
use Auth;

class userPaymentController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories, Tax $tax,ShippingLists $shippingLists, OrderProducts $order_products, Orders $orders){
        $this->country=$countries->all();
        $this->users = $users;
        $this->order_products = $order_products;
        $this->genders=$genders;
        $this->orders = $orders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
        $this->addresstypes = $addresstypes;
        $this->shipping_lists = $shippingLists;
        $this->tax_info = $tax->find(1);
        $this->checkout_menus=array(
            array(
                "name"=>"Shipping",
                "url"=>route("checkout_show_shipping")
            ),
            array(
                "name"=>"Payment & Billing",
                "url"=>route("checkout_show_shipping")
            ),
            array(
                "name"=>"Confirmation",
                "url"=>route("checkout_show_shipping")
            )
        );
    }
    public function showShipping(){
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["page_title"]="Select Shipping Address";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["countries"]=$this->country->all();
        $data["checkout_menus"]=$this->checkout_menus;
        return view("/checkout/shipping",$data);
    }
    public function saveShipping(Request $request){
        $this->validate($request,[
            "shipping_address"=>"required"
            ]
        );
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["page_title"]="Choose Billing and Payment Method";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["countries"]=$this->country->all();
        // $data["address_id"]=$request->input("shipping_address");
        $cart_data = array("shipping"=>$request->input("shipping_address"));
        $request->session()->put("cart_session",$cart_data);
        $data["checkout_menus"]=$this->checkout_menus;
        // return view("/checkout/billing",$data);
        return redirect()->route("checkout_show_billing")->with($data);
    }
    public function showBilling(Request $request){
        
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;

        $data["page_title"]="Choose Billing and Payment Method";
        $data["checkout_menus"]=$this->checkout_menus;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["address_id"]=$request->input("address_id");
        $data["shipping_lists"]=$this->shipping_lists->all();
        return view("/checkout/billing",$data);
    }
    public function processPayment(Request $request){
        $rules = [
            "billing_address"=>"required",
            "shipping_method"=>"required"
        ];
        $this->validate($request,$rules);

        if(empty($request->session()->has('cart_session'))){
            return redirect()->back()->withErrors([
                'required' => "Cart is Empty"
            ]);
        }
        
        $cart = $request->session()->get('cart_session');
        $shipping = $cart=$cart["shipping"];
        $billing = $request->input("billing_address");
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $shipping_list = $this->shipping_lists->find($request->input("shipping_method"));

        $nonce = $request->input('nonce', false);
        $today = carbon::now();
        $todayf = $today->format("dmY");
        $random = rand(0,9999);
        $order_number = "VES-".$todayf.$random;

        //GET TOTAL
        $data_products = [];
        $subtotal = 0;
        $total = 0;
        $tax = 0;
        $cart=Session::get("vestidos_shop");
        for($i=0;$i<sizeof($cart);$i++){
            $total += $cart[$i]["quantity"] * $cart[$i]["total"];
        }
        $tax = $this->tax_info->tax;
        $subtotal = ($total * $tax) + $total;
        $grand_total = $subtotal+$shipping_list->total;
        
        //PREPARE DATA
        $data["user_id"]=$user_id;
        $data["order_number"]=$order_number;
        $data["purchase_date"]=$today;
        $data["ship_address_id"]=$shipping;
        $data["bill_address_id"]=$billing;
        $data["order_total"]=$total;
        $data["order_tax"]=$tax;
        $data["order_shipping_type"]=$shipping_list->id;
        $data["order_shipping"]=$shipping_list->total;
        $data["ip"]=$request->ip();
        $data["status"]=9;
        $data["created_at"]=$today;


        $order = Orders::create($data);

        $data["user"]=$user;
        $data["page_title"]="Thank you";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["countries"]=$this->country->all();
        $data["checkout_menus"]=$this->checkout_menus;

        if(!empty($order->id)){
            for($i=0;$i<sizeof($cart);$i++){
                $data_products[] = array(
                    "order_id"=>$order->id,
                    "product_id"=>$cart[$i]["id"],
                    "quantity"=>$cart[$i]["quantity"],
                    "status"=>1,
                    "created_at"=>carbon::now()
                );
            }
            if(count($data_products)>0){
                if($this->order_products->insert($data_products)){

                    $status = Braintree_Transaction::sale([
                        'amount' => $grand_total,
                        'paymentMethodNonce' => $nonce,
                        'options' => [
                            'submitForSettlement' => True
                        ]
                    ]);
                    if($status->success){
                        $get_order = $this->orders->find($order->id);
                        $get_order->transaction_id=$status->transaction->id;
                        $get_order->payment_method=$status->transaction->paymentInstrumentType;
                        $get_order->credit_card_type=$status->transaction->creditCard["cardType"];
                        $get_order->credit_card_number=$status->transaction->creditCard["last4"];
                        $get_order->payment_status=$status->transaction->processorResponseText;
                        $get_order->save();
                        
                        $request->session()->forget('cart_session');
                        $request->session()->forget('vestidos_shop');
                        
                        $data["thankyou_title"]="Order Received";
                        $data["thankyou_msg"]="Success: Your order has been created";
                        $data["thankyou_img"]="checked.svg";
                        $data["thankyou_status"]=true;
                        return redirect()->route("order_received_confirmation")->with($data);
                    }else{
                        $get_order = $this->orders->find($order->id);
                        $get_order->delete();
                        return redirect()->back()->withErrors([
                            'required' => $status->message
                        ]);
                    }
                }
            }
        }
        $data["thankyou_title"]="Ops! there was a problem with your order";
        $data["thankyou_msg"]="An unexpected issue ocurred, please try again later";
        $data["thankyou_img"]="close_2.svg";
        $data["thankyou_status"]=false;
        return redirect()->route("order_received_confirmation")->with($data);
    }
}
