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
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use App\vestidosProducts as Products;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Braintree_Transaction;
use Auth;

class userPaymentController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories, Tax $tax,ShippingLists $shippingLists, OrderProducts $order_products, Orders $orders, Products $products, Colors $colors, Sizes $sizes){
        $this->country=$countries;
        $this->users = $users;
        $this->order_products = $order_products;
        $this->genders=$genders;
        $this->orders = $orders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->colors = $colors;
        $this->sizes = $sizes;
        $this->products=$products;
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
                "name"=>"Billing",
                "url"=>route("checkout_show_shipping")
            ),
            array(
                "name"=>"Confirmation",
                "url"=>route("checkout_show_shipping")
            )
        );
    }
    public function showShipping(){
        if(empty(Session::has("vestidos_shop"))){
            return redirect()->route("home_page");
        }
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["checkout_menu_prev_link"]="";
        $has_address = $user->getAddresses->first() ? true : false; 

        $data["page_title"] = $has_address ? "Select Shipping Address" : "Provide Shipping Address";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["countries"]=$this->country->all();
        $data["checkout_menus"]=$this->checkout_menus;
        $data["tax_info"]=$this->tax_info;
        $data["checkout_header_key"]="Shipping";
        $data["checkout_btn_name"]="Proceed to Billing";
        $data["shipping_lists"]=$this->shipping_lists->all();
        return view("/checkout/shipping",$data);
    }
    public function saveShipping(Request $request){
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $has_address = $user->getAddresses->first() ? true : false; 
        $rule=[];
        $data=[];
        if($has_address){
            $this->validate($request,[
                "shipping_address"=>"required",
                "shipping_method"=>"required"
            ]);
            $shipping = $this->addresses->find($request->input("shipping_address"));
            $shipping_name = $shipping->first_name;
            if(!empty($shipping->middle_name)){
                $shipping_name .= " ".$shipping->middle_name;
            }
            $shipping_name .= " ".$shipping->last_name;
            $shipping_country = $this->country->find($shipping->country_id);
            $cart_data = array(
                "shipping_name"=>$shipping_name,
                "shipping_address_1"=>$shipping->address_1,
                "shipping_address_2"=>$shipping->address_2,
                "shipping_city"=>$shipping->city,
                "shipping_state"=>$shipping->state,
                "shipping_country"=>$shipping_country->countryCode,
                "shipping_zip_code"=>$shipping->zip_code,
                "shipping_phone_number_1"=>$shipping->phone_number_1,
                "shipping_phone_number_2"=>$shipping->phone_number_2,
                "shipping_email"=>$shipping->email,
                "shipping_method"=>$request->input("shipping_method")
            );
        }
        else{
            $this->validate($request,[
                "shipping_name"=>"required",
                "shipping_address_1"=>"required",
                "shipping_city"=>"required",
                "shipping_state"=>"required",
                "shipping_country"=>"required",
                "shipping_zip_code"=>"required",
                "shipping_phone_number_1"=>"required",
                "shipping_email"=>"required",
                "shipping_method"=>"required"
            ]);
            $data["shipping_name"]=$request->input("shipping_name");
            $data["shipping_address_1"]=$request->input("shipping_address_1");
            $data["shipping_address_2"]=$request->input("shipping_address_2");
            $data["shipping_city"]=$request->input("shipping_city");
            $data["shipping_state"]=$request->input("shipping_state");
            $data["shipping_country"]=$request->input("shipping_country");
            $data["shipping_zip_code"]=$request->input("shipping_zip_code");
            $data["shipping_phone_number_1"]=$request->input("shipping_phone_number_1");
            $data["shipping_phone_number_2"]=$request->input("shipping_phone_number_1");
            $data["shipping_email"]=$request->input("shipping_email");
            $shipping_country = $this->country->find($request->input("shipping_country"));

            $cart_data = array(
                "shipping_name"=>$request->input("shipping_name"),
                "shipping_address_1"=>$request->input("shipping_address_1"),
                "shipping_address_2"=>$request->input("shipping_address_2"),
                "shipping_city"=>$request->input("shipping_city"),
                "shipping_state"=>$request->input("shipping_state"),
                "shipping_country"=>$shipping_country->countryCode,
                "shipping_zip_code"=>$request->input("shipping_zip_code"),
                "shipping_phone_number_1"=>$request->input("shipping_phone_number_1"),
                "shipping_phone_number_2"=>$request->input("shipping_phone_number_2"),
                "shipping_email"=>$request->input("shipping_email"),
                "shipping_method"=>$request->input("shipping_method")
            );
        }
        $request->session()->put("cart_session",$cart_data);
        return redirect()->route("checkout_show_billing")->with($data);
    }
    public function showBilling(Request $request){
        if(empty(Session::has("vestidos_shop"))){
            return redirect()->route("home_page");
        }
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["checkout_menu_prev_link"]=array("name"=>"Shipping","url"=>route('checkout_show_shipping'));

        $has_address = $user->getAddresses->first() ? true : false; 

        $data["page_title"] = $has_address ? "Choose Billing and Payment Method" : "Please Provide Billing and Payment Method";

        $data["checkout_menus"]=$this->checkout_menus;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $cart = $request->session()->get('cart_session');
        $shipping_cost=$this->shipping_lists->find($cart["shipping_method"]);

        $data["shipping_cost"]=$shipping_cost->total;
        $data["tax_info"]=$this->tax_info;
        $data["shipping_info"] = $cart;
        $data["shipping_method"]=$this->shipping_lists->find($cart["shipping_method"]);
        $data["countries"]=$this->country->all();
        $data["address_id"]=$request->input("address_id");
        $data["checkout_header_key"]="Billing";
        $data["checkout_btn_name"]="Complete Payment";
        $data["shipping_lists"]=$this->shipping_lists->all();
        return view("/checkout/billing",$data);
    }
    public function processPayment(Request $request){
        //if no session is available, redirect
        if(empty($request->session()->has('cart_session'))){
            return redirect()->back()->withErrors([
                'required' => "Cart is Empty"
            ]);
        }
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $has_address = $user->getAddresses->first() ? true : false; 

        $cart_address = $request->session()->get('cart_session');
        $shipping_list = $this->shipping_lists->find($cart_address["shipping_method"]);

        if($has_address){
            $this->validate($request,[
                "billing_address"=>"required"
            ]);
            $billing_id= $request->input("billing_address");
            $shipping_id=$cart_address["shipping_method"];

            $shipping= $this->addresses->find($shipping_id);
            $billing = $this->addresses->find($billing_id);

            $shipping_name = $shipping->first_name;
            if(!empty($shipping->middle_name)){
                $shipping_name .= " ".$shipping->middle_name;
            }
            $shipping_name .= " ".$shipping->last_name;
            $shipping_country = $this->country->find($shipping->country_id);
            $data["shipping_name"]=$shipping_name;
            $data["shipping_address_1"]=$shipping->address_1;
            $data["shipping_address_2"]=$shipping->address_2;
            $data["shipping_city"]=$shipping->city;
            $data["shipping_state"]=$shipping->state;
            $data["shipping_country"]=$shipping_country->countryCode;
            $data["shipping_zip_code"]=$shipping->zip_code;
            $data["shipping_phone_number_1"]=$shipping->phone_number_1;
            $data["shipping_phone_number_2"]=$shipping->phone_number_2;
            $data["shipping_email"]=$shipping->email;
            

            $billing_name = $billing->first_name;
            if(!empty($billing->middle_name)){
                $billing_name .= " ".$billing->middle_name;
            }
            $billing_name .= " ".$billing->last_name;
            $billing_country = $this->country->find($billing->country_id);
            $data["billing_name"]=$billing_name;
            $data["billing_address_1"]=$billing->address_1;
            $data["billing_address_2"]=$billing->address_2;
            $data["billing_city"]=$billing->city;
            $data["billing_state"]=$billing->state;
            $data["billing_country"]=$billing_country->countryCode;
            $data["billing_zip_code"]=$billing->zip_code;
            $data["billing_phone_number_1"]=$billing->phone_number_1;
            $data["billing_phone_number_2"]=$billing->phone_number_2;
            $data["billing_email"]=$billing->email;
        
        }else{
            $this->validate($request,[
                "billing_name"=>"required",
                "billing_address_1"=>"required",
                "billing_city"=>"required",
                "billing_state"=>"required",
                "billing_country"=>"required",
                "billing_zip_code"=>"required",
                "billing_phone_number_1"=>"required",
                "billing_email"=>"required"
            ]);

            $data["shipping_name"]=$cart_address["shipping_name"];
            $data["shipping_address_1"]=$cart_address["shipping_address_1"];
            $data["shipping_address_2"]=$cart_address["shipping_address_2"];
            $data["shipping_city"]=$cart_address["shipping_city"];
            $data["shipping_state"]=$cart_address["shipping_state"];
            $data["shipping_country"]=$cart_address["shipping_country"];
            $data["shipping_zip_code"]=$cart_address["shipping_zip_code"];
            $data["shipping_phone_number_1"]=$cart_address["shipping_phone_number_1"];
            $data["shipping_phone_number_2"]=$cart_address["shipping_phone_number_2"];
            $data["shipping_email"]=$cart_address["shipping_email"];
            

            $billing_name = $request->input("billing_name");
            $billing_country = $this->country->find($request->input("billing_country"));
            $data["billing_name"]=$billing_name;
            $data["billing_address_1"]=$request->input("billing_address_1");
            $data["billing_address_2"]=$request->input("billing_address_2");
            $data["billing_city"]=$request->input("billing_city");
            $data["billing_state"]=$request->input("billing_state");
            $data["billing_country"]=$billing_country->countryCode;
            $data["billing_zip_code"]=$request->input("billing_zip_code");
            $data["billing_phone_number_1"]=$request->input("billing_phone_number_1");
            $data["billing_phone_number_2"]=$request->input("billing_phone_number_2");
            $data["billing_email"]=$request->input("billing_email");

        }
        
        $nonce = $request->input('nonce', false);
        $today = carbon::now();
        $todayf = $today->format("dmY");
        $random = rand(0,9999);
        $order_number = "VES-".$todayf.$random;

        //GET TOTAL
        $data_products = [];
        $data_products_email = [];
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
                    "total"=>$cart[$i]["total"],
                    "color_id"=>$cart[$i]["color_id"],
                    "size_id"=>$cart[$i]["size_id"],
                    "status"=>1,
                    "created_at"=>$today
                );
                //for email
                $product_detail = $this->products->find($cart[$i]["id"]);
                $size_detail = $this->sizes->find($cart[$i]["size_id"]);
                $color_detail = $this->colors->find($cart[$i]["color_id"]);
                $data_products_email[] = array(
                    "quantity"=>$cart[$i]["quantity"],
                    "total"=>$cart[$i]["total"],
                    "color"=>$color_detail->name,
                    "size"=>$size_detail->name,
                    "name"=>$product_detail->products_name,
                    "total"=>$product_detail->product_total,
                    "model"=>$product_detail->product_model,
                    "img"=>$product_detail->images()->first()->img_url,
                    "id"=>$product_detail->id
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
                        
                        //SEND EMAIL
                        

                        $order_detail=[
                            "user"=>$this->users->find($user_id),
                            "order"=>array(                        
                                "order_number"=>$order_number,
                                "purchase_date"=>$today,
                                "shipping_name"=>$cart_address["shipping_name"],
                                "shipping_address_1"=>$cart_address["shipping_address_1"],
                                "shipping_address_2"=>$cart_address["shipping_address_2"],
                                "shipping_city"=>$cart_address["shipping_city"],
                                "shipping_state"=>$cart_address["shipping_state"],
                                "shipping_country"=>$cart_address["shipping_country"],
                                "shipping_zip_code"=>$cart_address["shipping_zip_code"],
                                "shipping_phone_number_1"=>$cart_address["shipping_phone_number_1"],
                                "shipping_phone_number_2"=>$cart_address["shipping_phone_number_2"],
                                "shipping_email"=>$cart_address["shipping_email"],
                                "billing_name"=>$request->input("billing_name"),
                                "billing_address_1"=>$request->input("billing_address_1"),
                                "billing_address_2"=>$request->input("billing_address_2"),
                                "billing_city"=>$request->input("billing_city"),
                                "billing_state"=>$request->input("billing_state"),
                                "billing_country"=>$request->input("billing_country"),
                                "billing_zip_code"=>$request->input("billing_zip_code"),
                                "billing_phone_number_1"=>$request->input("billing_phone_number_1"),
                                "billing_phone_number_2"=>$request->input("billing_phone_number_2"),
                                "billing_email"=>$request->input("billing_email"),
                                "products"=>$data_products_email,
                                "order_total"=>$total,
                                "order_tax"=>$tax,
                                "status"=>$get_order->getStatusName->name,
                                "shipping_total"=>$shipping_list->total
                            )
                        ];
                        
                        //send email to client
                        Mail::send('emails.orderreceived',["order_detail"=>$order_detail],function($message) use($order_detail){
                            $message->from("info@vestidosboutique.com","Vestidos Boutique");
                            $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                            $subject = 'Hello '.$client_name.', thank you for your order';
                            //$message->to($order_detail["user"]["email"],$client_name)->subject($subject);
                            $message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
                        });
                        
                        //send email to admin
                        Mail::send('emails.admin_orderreceived',["order_detail"=>$order_detail],function($message) use($order_detail){
                            $message->from("info@vestidosboutique.com","Vestidos Boutique");
                            $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                            $subject = 'Hello Admin, new order received from '.$client_name;
                            //$message->to("info@vestidosboutique.com","Admin")->subject($subject);
                            $message->to("evil_luis@hotmail.com","Admin")->subject($subject);
                        });


                       // DESTROY SESSION
                        $request->session()->forget('cart_session');
                        $request->session()->forget('vestidos_shop');

                        $request->session()->flash('alert-success', 'User was successful added!');
                        return redirect()->route("checkout_order_received");
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

        return redirect()->route("checkout_order_received");
    }
    public function showOrderReceived(){
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $last_order=$user->orders()->orderBy('created_at','desc')->first();
        $data["last_order"]=$last_order;
        $data["checkout_menu_prev_link"]="";
        $data["page_title"]="Success: Your order has been received";
        $data["checkout_menus"]=$this->checkout_menus;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["tax_info"]=$this->tax_info;
        $data["checkout_header_key"]="Confirmation";
        $data["checkout_btn_name"]="Return Home Page";
        $data["thankyou_msg"]="Thank you for your order! we are processing your order, once your order is update you will notify you right away!.";
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        if(empty(Session::has("alert-success"))){
            $data["page_title"]="Ops!";
            $data["thankyou_msg"]="Access Denied.";
            $data["thankyou_img"]="close_2.svg";
            $data["thankyou_status"]=false;
        }
        return view("/checkout/confirmation",$data);
    }
    
}
