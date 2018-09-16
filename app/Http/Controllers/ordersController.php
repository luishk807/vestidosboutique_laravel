<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosOrdersProducts as OrdersProducts;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosCountries as Countries;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;
use App\vestidosOrderCancelReasons as CancelReasons;
use Illuminate\Support\Facades\DB;
use App\vestidosShippingLists as ShippingLists;
use App\vestidosSizes as Sizes;
use App\vestidosColors as Colors;
use App\vestidosPaymentHistories as PaymentHistories;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosTaxInfos as Tax;
use Braintree_Transaction;
use Mail;
use Auth;
use Session;

class ordersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products,CancelReasons $cancel_reasons,ShippingLists $shippingLists, Countries $countries,Sizes $sizes,Colors $colors,PaymentHistories $payment_histories,AddressTypes $address_types,Tax $tax){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->countries = $countries;
        $this->payment_histories = $payment_histories;
        $this->shipping_lists = $shippingLists;
        $this->cancel_reasons=$cancel_reasons;
        $this->products=$products;
        $this->addresses=$addresses;
        $this->colors=$colors;
        $this->sizes=$sizes;
        $this->tax_info = $tax->find(1);
        $this->address_types = $address_types;
    }
    public function index(){
        $data=[];
        $data["orders"]=$this->orders->orderBy('created_at','desc')->paginate(10);
        $data["page_title"]=__('header.orders');
        return view("admin/orders/home",$data);
    }
    public function getAddressDropdown(){
        $user_id=Input::get('data');
        $users = $this->users->find($user_id);
        return response()->json($users->getAddresses()->get());
    }
    public function getProductDropdown(){
        $product_id=Input::get('data');
        $product = $this->products->find($product_id);
        return response()->json($product);
    }
    public function newOrders(){
        $data=[];
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]=__('general.order_section.new_order');
        return view("admin/orders/new",$data);
    }
    public function createOrder(Request $request){
        $data=[];
        $user_id=(int)$request->input("user");
        $data["user_id"]=$user_id;
        $data["purchase_date"]=$request->input("purchase_date");
        $data["status"]=(int)$request->input("status");
        $ip=$request->ip();
        $data["ip"]=$ip;
        $this->validate($request,[
            "user"=>"required",
            "purchase_date"=>"required",
            "status"=>"required"
        ]
        );
        // $date = carbon::now();
        // $data["created_at"]=$date;
        // $time_converted =carbon::createFromFormat('Y-m-d H:i:s', $date)->format('YmdHise'); //get today date time
        // $order_number = "VB".$time_converted."-".$user_id;
        // $data["order_number"]=$order_number;

        if(Session::has("vestidos_admin_shop")){
            Session::forget("vestidos_admin_shop");
        }
        Session::put("vestidos_admin_shop",$data);
        return redirect()->route("admin_show_new_order_address");
        
    }
    public function editOrder($order_id){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order"]=$order;
        $data["order_id"]=$order_id;
      
        $user=$this->users->find($order->user_id);
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["shipping_lists"]=$this->shipping_lists->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]=__('general.order_section.edit_order');
        return view("admin/orders/edit",$data);
    }
    public function showOrderAddress(){
        $data=[];
        $user=[];
        if(Session::has("vestidos_admin_shop")){
            $session=Session::get("vestidos_admin_shop");
            $user = $this->users->find($session["user_id"]);
        }
        $data["user"]=$user;
        $data["shipping_lists"]=$this->shipping_lists->all();
        $data["address_types"]=$this->address_types->all();
        $data["countries"]=$this->countries->all();
        $data["user_adresses"]=$this->addresses->all();
        $data["page_title"]=__('general.order_section.new_order_address');
        return view("admin/orders/addresses/new",$data);
    }
    public function createOrderAddress(Request $request){
        $data=[];
        if(Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with("error",__('general.access_section.invalid_access'));
        }
        $addresses=$request->input("addresses");
        if(count($addresses) < 1){
            $this->validate($request,[
                "name"=>"required",
                "address_1"=>"required",
                "city"=>"required",
                "state"=>"required",
                "country"=>"required",
                "zip_code"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required"
            ]);
        }
        foreach($addresses as $address){
            $address_type = $this->address_types->find($address["address_type"]);
            if($address["address_type"]==1){
                if(array_key_exists('user_address_id', $address)){
                    $user_address=$this->addresses->find($address["user_address_id"]);
                    $country = $this->countries->find($user_address->country_id);
                    $data["shipping_name"]=$user_address->getFullName();
                    $data["shipping_address_1"]=$user_address->address_1;
                    $data["shipping_address_2"]=$user_address->address_2;
                    $data["shipping_city"]=$user_address->city;
                    $data["shipping_state"]=$user_address->state;
                    $data["shipping_country"]=$user_address->country_id;
                    $data["shipping_country_name"] = $country->countryCode;
                    $data["shipping_zip_code"]=$user_address->zip_code;
                    $data["shipping_phone_number_1"]=$user_address->phone_number_1;
                    $data["shipping_phone_number_2"]=$user_address->phone_number_2;
                    $data["shipping_email"]=$user_address->email;
                }else{
                    $country = $this->countries->find($address["country"]);
                    $data["shipping_name"]=$address["name"];
                    $data["shipping_address_1"]=$address["address_1"];
                    $data["shipping_address_2"]=$address["address_2"];
                    $data["shipping_city"]=$address["city"];
                    $data["shipping_state"]=$address["state"];
                    $data["shipping_country"]=$address["country"];
                    $data["shipping_country_name"] = $country->countryCode;
                    $data["shipping_zip_code"]=$address["zip_code"];
                    $data["shipping_phone_number_1"]=$address["phone_number_1"];
                    $data["shipping_phone_number_2"]=$address["phone_number_2"];
                    $data["shipping_email"]=$address["email"];
                }
            }
            elseif($address["address_type"]==2){
                if(array_key_exists('user_address_id', $address)){
                    $address=$this->addresses->find($address["user_address_id"]);
                    $country = $this->countries->find($user_address->country_id);
                    $data["billing_name"]=$user_address->getFullName();
                    $data["billing_address_1"]=$user_address->address_1;
                    $data["billing_address_2"]=$user_address->address_2;
                    $data["billing_city"]=$user_address->city;
                    $data["billing_state"]=$user_address->state;
                    $data["billing_country"]=$user_address->country_id;
                    $data["billing_country_name"] = $country->countryCode;
                    $data["billing_zip_code"]=$user_address->zip_code;
                    $data["billing_phone_number_1"]=$user_address->phone_number_1;
                    $data["billing_phone_number_2"]=$user_address->phone_number_2;
                    $data["billing_email"]=$user_address->email;
                }else{
                    $country = $this->countries->find($address["country"]);
                    $data["billing_name"]=$address["name"];
                    $data["billing_address_1"]=$address["address_1"];
                    $data["billing_address_2"]=$address["address_2"];
                    $data["billing_city"]=$address["city"];
                    $data["billing_state"]=$address["state"];
                    $data["billing_country"]=$address["country"];
                    $data["billing_country_name"] = $country->countryCode;
                    $data["billing_zip_code"]=$address["zip_code"];
                    $data["billing_phone_number_1"]=$address["phone_number_1"];
                    $data["billing_phone_number_2"]=$address["phone_number_2"];
                    $data["billing_email"]=$address["email"];
                }
            }else{
                return redirect()->back()->with("error",__('general.address_section.invalid'));
            }
        }
        $shipping_list=$this->shipping_lists->find($request->input("shipping_list"));
        $data["shipping_list"]=$shipping_list;
        if(Session::has("vestidos_admin_shop")){
            Session::forget("vestidos_admin_shop");
        }
        Session::put("vestidos_admin_shop",$data);
        return redirect()->route("admin_new_order_products");
        
    }
    public function editOrderAddress(Request $request, $order_id,$address_type_id){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order"]=$order;
        $address_var = $address_type_id==1? __('general.cart_title.shipping') : __('general.cart_title.billing');
        $data["order_id"]=$order_id;
        $data["address_var"]=$address_var;
        $data["page_title"]=__('general.order_section.edit_order_address',["name"=>$address_var]);
        $data["address_type_id"]=$address_type_id;
        $data["countries"]= $this->countries->all();
        $data["address_name"]=$request->input("address_name");
        $data["address_email"]=$request->input("address_email");
        $data["address_phone_number_1"]=$request->input("address_phone_number_1");
        $data["address_phone_number_2"]=$request->input("address_phone_number_2");
        $data["address_address_1"]=$request->input("address_address_1");
        $data["address_address_2"]=$request->input("address_address_2");
        $data["address_city"]=$request->input("address_city");
        $data["address_state"]=$request->input("address_phone_state");
        $data["address_country"]=$request->input("address_country");
        $data["address_zip_code"]=$request->input("address_zip_code");
        if($address_type_id==1){
            $data["order_address_name"]=$order->shipping_name;
            $data["order_address_email"]=$order->shipping_email;
            $data["order_address_phone_number_1"]=$order->shipping_phone_number_1;
            $data["order_address_phone_number_2"]=$order->shipping_phone_number_2;
            $data["order_address_address_1"]=$order->shipping_address_1;
            $data["order_address_address_2"]=$order->shipping_address_2;
            $data["order_address_city"]=$order->shipping_city;
            $data["order_address_state"]=$order->shipping_state;
            $data["order_address_country"]=$order->shipping_country;
            $data["order_address_zip_code"]=$order->shipping_zip_code;
        }else if($address_type_id==2){
            $data["order_address_name"]=$order->billing_name;
            $data["order_address_email"]=$order->billing_email;
            $data["order_address_phone_number_1"]=$order->billing_phone_number_1;
            $data["order_address_phone_number_2"]=$order->billing_phone_number_2;
            $data["order_address_address_1"]=$order->billing_address_1;
            $data["order_address_address_2"]=$order->billing_address_2;
            $data["order_address_city"]=$order->billing_city;
            $data["order_address_state"]=$order->billing_state;
            $data["order_address_country"]=$order->billing_country;
            $data["order_address_zip_code"]=$order->billing_zip_code;
        }
        return view("admin/orders/addresses/edit",$data);
    }
    public function saveOrderAddress(Request $request){
        $data=[];
        $this->validate($request,[
            "address_name"=>"required",
            "address_email"=>"required",
            "address_phone_number_1"=>"required",
            "address_address_1"=>"required",
            "address_city"=>"required",
            "address_state"=>"required",
            "address_country"=>"required",
            "address_zip_code"=>"required"
        ]);
        $order_id=$request->input("order_id");
        $address_type_id=$request->input("address_type_id");
        $order =$this->orders->find($order_id);
        $address_var = $address_type_id==1? __('general.cart_title.shipping') : __('general.cart_title.billing');
        $data["order_id"]=$order_id;
        $data["address_var"]=$address_var;
        $data["page_title"]= __('general.order_section.edit_order_address',["name"=>$address_var]);

        if($address_type_id==1){
            $order->shipping_name=$request->input("address_name");
            $order->shipping_email=$request->input("address_email");
            $order->shipping_phone_number_1=$request->input("address_phone_number_1");
            $order->shipping_phone_number_2=$request->input("address_phone_number_2");
            $order->shipping_address_1=$request->input("address_address_1");
            $order->shipping_address_2=$request->input("address_address_2");
            $order->shipping_city=$request->input("address_city");
            $order->shipping_state=$request->input("address_state");
            $order->shipping_country=$request->input("address_country");
            $order->shipping_zip_code=$request->input("address_zip_code");
        }else if($address_type_id==2){
            $order->billing_name=$request->input("address_name");
            $order->billing_email=$request->input("address_email");
            $order->billing_phone_number_1=$request->input("address_phone_number_1");
            $order->billing_phone_number_2=$request->input("address_phone_number_2");
            $order->billing_address_1=$request->input("address_address_1");
            $order->billing_address_2=$request->input("address_address_2");
            $order->billing_city=$request->input("address_city");
            $order->billing_state=$request->input("address_state");
            $order->billing_country=$request->input("address_country");
            $order->billing_zip_code=$request->input("address_zip_code");
        }
        if($order->save()){
            return redirect()->route("admin_edit_order",["order_id"=>$order_id])->with("success",__('general.order_section.address_saved'));
        }
        return redirect()->back()->withErrors([
            "required"=>__('general.unable_save')
        ]);
    }
    public function saveOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $shipping_list = $this->shipping_lists->find($request->input("shipping_method"));
        $data["order_id"]=$order_id;
        $data["purchase_date"]=$request->input("purchase_date");
        $data["shipping_date"]=$request->input("shipping_date");
        $data["order_quantity"]=(int)$request->input("order_quantity");
        $data["order_total"]=$request->input("order_total");
        $data["order_tax"]=$request->input("order_tax");
        $data["shipping_method"]=$request->input("shipping_method");
        $data["status"]=(int)$request->input("status");
        $data["ip"]=$request->ip();
        $this->validate($request,[
            "user"=>"required",
            "purchase_date"=>"required",
            "order_total"=>"required",
            "order_tax"=>"required",
            "shipping_method"=>"required",
            "status"=>"required",
        ]);
        $current_status=$order->status;
        $order->updated_at=carbon::now();
        $order->user_id=(int)$request->input("user");
        $order->purchase_date=$request->input("purchase_date");
        $order->shipping_date=$request->input("shipping_date");
        $order->order_shipping_type=(int)$request->input("shipping_method");
        $order->order_shipping = $shipping_list->total;
        $order->order_total=$request->input("order_total");
        $order->order_tax=$request->input("order_tax");
        $order->status=(int)$request->input("status");
        if($order->status==2){
            $order->order_total_refund=$request->input("order_total_refund");
            $order->order_refund_date=$request->input("order_refund_date");
        }
        $order->ip=$request->ip();
        $order->save();
        if($current_status != $request->input("status")){
            $order_detail = $this->sendEmail($order_id);

            Mail::send('emails.orderstatus_update',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_user.updated',['name'=>$client_name]);
                $message->to("info@vestidosboutique.com","Admin")->subject($subject);
            });
        }
        return redirect()->route("admin_orders");
    }
    public function confirmCancel($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["cancel_reasons"]=$this->cancel_reasons->all();
        $data["page_title"]=__('general.order_section.confirm_cancellation');
        return view("admin/orders/confirm_cancel",$data);
    }
    public function showAdminOrderCheckout(){
        $data=[];
        if(Session::has("vestidos_admin_shop")){
            $data = Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with("error",__('general.access_section.invalid_access'));
        }
        $data["page_title"]=__('general.order_section.new_order_checkout');
        return view("admin/orders/payments/checkout",$data);
    }
    public function processAdminOrderCheckout(Request $request){

        $grand_total = $request->input("order_total");
        if(Session::has("vestidos_admin_shop")){
            $cart = Session::get("vestidos_admin_shop");
            $user = $this->users->find($cart["user_id"]);
            $user_id=$user->id;
        }else{
            return redirect()->route('admin_orders')->with("error",__('general.access_section.invalid_access'));
        }
        $shipping_list = $cart["shipping_list"];
        $nonce = $request->input('nonce', false);
        $today = carbon::now();
        $todayf = $today->format("dmY");
        $random = rand(0,99);
        $order_number = "VES-".$todayf.$user_id.$random;

        $status = Braintree_Transaction::sale([
            'amount' => $grand_total,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        if($status->success){
            $data["user_id"]=$cart["user_id"];
            $data["order_number"]=$order_number;
            $data["purchase_date"]=$today;
            $data["shipping_name"]=$cart["shipping_name"];
            $data["shipping_address_1"]=$cart["shipping_address_1"];
            $data["shipping_address_2"]=$cart["shipping_address_2"];
            $data["shipping_city"]=$cart["shipping_city"];
            $data["shipping_state"]=$cart["shipping_state"];
            $data["shipping_country"]=$cart["shipping_country"];
            $data["shipping_zip_code"]=$cart["shipping_zip_code"];
            $data["shipping_phone_number_1"]=$cart["shipping_phone_number_1"];
            $data["shipping_phone_number_2"]=$cart["shipping_phone_number_2"];
            $data["shipping_email"]=$cart["shipping_email"];

            $data["billing_name"]=$cart["billing_name"];
            $data["billing_address_1"]=$cart["billing_address_1"];
            $data["billing_address_2"]=$cart["billing_address_2"];
            $data["billing_city"]=$cart["billing_city"];
            $data["billing_state"]=$cart["billing_state"];
            $data["billing_country"]=$cart["billing_country"];
            $data["billing_zip_code"]=$cart["billing_zip_code"];
            $data["billing_phone_number_1"]=$cart["billing_phone_number_1"];
            $data["billing_phone_number_2"]=$cart["billing_phone_number_2"];
            $data["billing_email"]=$cart["billing_email"];


            $data["transaction_id"]=$status->transaction->id;
            $data["payment_method"]=$status->transaction->paymentInstrumentType;
            $data["credit_card_type"]=$status->transaction->creditCard["cardType"];
            $data["credit_card_number"]=$status->transaction->creditCard["last4"];
            $data["payment_status"]=$status->transaction->processorResponseText;
            $data["order_total"]=$grand_total;
            $data["order_tax"]=$cart["order_tax"];
            $data["order_shipping"]=$cart["order_shipping"];
            $data["grand_total"]=$grand_total;
            
            $data["status"]=9;
            $data["ip"] = $request->ip();
            $data["order_shipping_type"] = $shipping_list->id;
            
            // $data["products"]=$cart_p;
            $order = Orders::create($data);
            
            //SAVE PAYMENT HISTORIES
            $new_payment=[];
            $new_payment["order_id"]=$order->id;
            $new_payment["total"]=$grand_total;
            $new_payment["user_id"]=$order->user_id;
            $new_payment["transaction_id"]=$status->transaction->id;
            $new_payment["payment_method"]=$status->transaction->paymentInstrumentType;
            $new_payment["credit_card_type"]=$status->transaction->creditCard["cardType"];
            $new_payment["credit_card_number"]=$status->transaction->creditCard["last4"];
            $new_payment["payment_status"]=$status->transaction->processorResponseText;
            $new_payment["ip"]=$request->ip();
            $new_payment["created_at"]=carbon::now();
            $this->payment_histories->insert($new_payment);

            //save to products
            $new_product=[];
            $data_products_email=[];
            foreach($cart["products"] as $product){
                $new_product["product_id"]=$product["id"];
                $new_product["order_id"]=$order->id;
                $new_product["quantity"]=$product["quantity"];
                $new_product["total"]=$product["total"];
                $new_product["color_id"]=$product["color_id"];
                $new_product["size_id"]=$product["size_id"];
                $new_product["status"]=9;
                $new_product["created_at"]=$today;

                $this->order_products->insert($new_product);
            }
             //send email to user
            $order_detail = $this->sendEmail($order->id);
             
             //send email to client
             Mail::send('emails.orderreceived',["order_detail"=>$order_detail],function($message) use($order_detail){
                 $message->from("info@vestidosboutique.com","Vestidos Boutique");
                 $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                 $subject = __('general.order_section.to_user.received',['name'=>$client_name]);
                 $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
                 //$message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
             });
             Session::forget("vestidos_admin_shop");
            return redirect()->route('admin_orders')->with("success",__('general.order_section.order_success_created_none'));
        }
        return redirect()->back()->withErrors([
            "required"=>$status->message
        ]);
    }
    public function showAdminOrderPayment($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]=__('general.order_section.process_order');
        return view("admin/orders/payments/edit",$data);
    }
    public function orderAdminProcessPayment(Request $request,$order_id){

        $this->validate($request,[
            'order_total' => "required"
        ]);
        $grand_total = $request->input("order_total");
        $order=$this->orders->find($order_id);
        $nonce = $request->input('nonce', false);
        $today = carbon::now();
        $status = Braintree_Transaction::sale([
            'amount' => $grand_total,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        if($status->success){
            $order->order_total = $request->input('order_total');
            $order->updated_at=$today;

            $order->transaction_id=$status->transaction->id;
            $order->payment_method=$status->transaction->paymentInstrumentType;
            $order->credit_card_type=$status->transaction->creditCard["cardType"];
            $order->credit_card_number=$status->transaction->creditCard["last4"];
            $order->payment_status=$status->transaction->processorResponseText;
            $order->save();

            //SAVE PAYMENT HISTORIES
            $new_payment=[];
            $new_payment["order_id"]=$order->id;
            $new_payment["user_id"]=$order->user_id;
            $new_payment["total"]=$grand_total;
            $new_payment["transaction_id"]=$status->transaction->id;
            $new_payment["payment_method"]=$status->transaction->paymentInstrumentType;
            $new_payment["credit_card_type"]=$status->transaction->creditCard["cardType"];
            $new_payment["credit_card_number"]=$status->transaction->creditCard["last4"];
            $new_payment["payment_status"]=$status->transaction->processorResponseText;
            $new_payment["ip"]=$request->ip();
            $new_payment["created_at"]=carbon::now();
            $this->payment_histories->insert($new_payment);

            return redirect()->route('admin_edit_order',["order_id"=>$order_id])->with("success",__('general.order_section.order_completed'));
        }
        return redirect()->back()->withErrors([
            "required"=>$status->message
        ]);
    }
    public function cancelOrder($order_id,Request $request){
        $data=[];
        $order = $this->orders->find($order_id);
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user_id=$order->user_id;
        $order->status=2;
        $order->cancel_reason=$request->input('cancel_reason');
        $order->cancel_user=$user_id;
        $today=carbon::now();
        $data_products_email=[];
        if($order->save()){
            DB::table('vestidos_orders_products')->where("id",$order->id)->update(["status"=>2]);
            //send email to user
            $order_detail = $this->sendEmail($order_id);

            Mail::send('emails.ordercancel_confirm',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_user.cancel',['name'=>$client_name]);
                $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
            });
        }
        return redirect()->route("admin_orders")->with('success',__('general.order_section.cancel_success'));
    }
    public function sendEmail($order_id){
        $order=$this->orders->find($order_id);
        $user_id = $order->user_id;
        $today = carbon::now();
        foreach($order->products as $product){
            $product_detail = $this->products->find($product->getProduct->id);
            $size_detail = $this->sizes->find($product->size_id);
            $color_detail = $this->colors->find($product->color_id);
            $data_products_email[] = array(
                "quantity"=>$product->quantity,
                "total"=>$product->total,
                "color"=>$color_detail->name,
                "size"=>$size_detail->name,
                "name"=>$product_detail->products_name,
                "total"=>$product_detail->total_rent,
                "model"=>$product_detail->product_model,
                "img"=>$product_detail->images()->first()->img_url,
                "id"=>$product_detail->id
            );
        }
        $order_detail=[
            "user"=>$this->users->find($user_id),
            "order"=>array(                        
                "order_number"=>$order->order_number,
                "purchase_date"=>$today,
                "shipping_name"=>$order->shipping_name,
                "shipping_address_1"=>$order->shipping_address_1,
                "shipping_address_2"=>$order->shipping_address_2,
                "shipping_city"=>$order->shipping_city,
                "shipping_state"=>$order->shipping_state,
                "shipping_country"=>$order->getShippingCountry->countryCode,
                "shipping_zip_code"=>$order->shipping_zip_code,
                "shipping_phone_number_1"=>$order->shipping_phone_number_1,
                "shipping_phone_number_2"=>$order->shipping_phone_number_2,
                "shipping_email"=>$order->shipping_email,
                "billing_name"=>$order->billing_name,
                "billing_address_1"=>$order->billing_address_1,
                "billing_address_2"=>$order->billing_address_2,
                "billing_city"=>$order->billing_city,
                "billing_state"=>$order->billing_state,
                "billing_country"=>$order->getBillingCountry->countryCode,
                "billing_zip_code"=>$order->billing_zip_code,
                "billing_phone_number_1"=>$order->billing_phone_number_1,
                "billing_phone_number_2"=>$order->billing_phone_number_2,
                "billing_email"=>$order->billing_email,
                "products"=>$data_products_email,
                "order_total"=>$order->order_total,
                "order_tax"=>$order->order_tax,
                "status"=>$order->getStatusName->name,
                "shipping_total"=>$order->order_shipping,
                "order_grand_total"=>$order->order_total + $order->order_tax + $order->order_shipping,
            )
        ];
        return $order_detail;
    }
    public function confirmDelete($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]=__('general.order_section.confirm_cancellation');
        return view("admin/orders/confirm_delete",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        $order = $this->orders->find($order_id);
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user_id=$order->user_id;
        if($order->delete()){
            return redirect()->route("admin_orders")->with('success',__('general.order_section.order_success_deleted'));
        }
        return redirect()->route("admin_orders")->with('error',__('general.order_section.unable_delete'));
    }
}
