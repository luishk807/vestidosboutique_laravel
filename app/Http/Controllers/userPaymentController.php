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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Braintree_Transaction;
use Auth;

class userPaymentController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories, Tax $tax){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
        $this->addresstypes = $addresstypes;
        $this->tax = $tax->find(1);
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
        // return view("/checkout/billing",$data);
        if($request->session()->has('cart_session'))
        {
            $cart = $request->session()->get('cart_session');
            print_r($cart);
        }
        else
            echo 'No data in the session';
        dd($data);
    }
    // public function saveBilling(Request $request){
    //     // $data=[];
    //     // $user_id=Auth::guard("vestidosUsers")->user()->getId();
    //     // $user = $this->users->find($user_id);
    //     // $data["user"]=$user;
    //     // $data["page_title"]="Billing";
    //     // $data["brands"]=$this->brands->all();
    //     // $data["categories"]=$this->categories->all();
    //     // $data["countries"]=$this->country->all();
    //     // $data["address_id"]=$request->input("address_id");
    //     // return redirect()->route('checkout_page')->with($data);
    //     dd($request);
    // }
    public function process(Request $request){
        $this->validate($request,[
            "billing_address"=>"required"
            ]
        );

        if(empty($request->session()->has('cart_session'))){
            return redirect()->back();
        }
    
        $cart = $request->session()->get('cart_session');
        $shipping = $cart=$cart["shipping"];
        $billing = $request->input("billing_address");
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);

        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $today = carbon::now();
        $todayf = carbon::createFromFormat("dmY",$today);
        $random = rand(0,9999);
        $order_number = "VES-".$todayf.$random;

        $data["user_id"]=$user_id;
        $data["order_number"]=$order_number;
        $data["purchase_date"]=$today;
        $data["ship_address_id"]=$shipping;
        $data["bill_address_id"]=$billing;
        $data["order_total"]="";
        $data["order_tax"]="";
        $data["order_shipping"]="5.00";
        $data["ip"]=$request->ip();
        $data["status"]=9;
        $data["created_at"]=$today;

        //GET TOTAL
        $subtotal = 0;
        $tax = 0;
        if(Session::has("vestidos_shop")){
            $cart=Session::get("vestidos_shop");
            for($i=0;$i<sizeof($cart);$i++){
                $subtotal += $cart[$i]["quantity"] * $cart[$i]["total"];
            }
        }
        $tax = $this->tax->tax;
        $status = Braintree_Transaction::sale([
        'amount' => '10.00',
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => True
        ]
        ]);

        dd($status);
        // $data["user"]=$user;
        // $data["page_title"]="Thank you";
        // $data["brands"]=$this->brands->all();
        // $data["categories"]=$this->categories->all();
        // $data["countries"]=$this->country->all();
        // $data["checkout_menus"]=$this->checkout_menus;

    //     return response()->json($status);
    //    // dd($request);
    }
}
