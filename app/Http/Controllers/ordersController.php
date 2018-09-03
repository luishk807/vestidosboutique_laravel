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
use Braintree_Transaction;
use Mail;
use Auth;
use Session;

class ordersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products,CancelReasons $cancel_reasons,ShippingLists $shippingLists, Countries $countries,Sizes $sizes,Colors $colors,PaymentHistories $payment_histories,AddressTypes $address_types){
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
        $this->address_types = $address_types;
    }
    public function index(){
        $data=[];
        $data["orders"]=$this->orders->orderBy('created_at','desc')->paginate(10);
        $data["page_title"]="Orders";
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
        $data["page_title"]="New Order";
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
        $data["page_title"]="Edit Order";
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
        $data["address_types"]=$this->address_types->all();
        $data["countries"]=$this->countries->all();
        $data["user_adresses"]=$this->addresses->all();
        $data["page_title"]="New Order | Address";
        return view("admin/orders/addresses/new",$data);
    }
    public function createOrderAddress(Request $request){
        $data=[];
        if(Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with("error","Invalid access");
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
                if($address["user_address_id"]){
                    $user_address=$this->addresses->find($address["user_address_id"]);
                    $data["shipping_name"]=$user_address->getFullName();
                    $data["shipping_address_1"]=$user_address->address_1;
                    $data["shipping_address_2"]=$user_address->address_2;
                    $data["shipping_city"]=$user_address->city;
                    $data["shipping_state"]=$user_address->state;
                    $data["shipping_country"]=$user_address->country_id;
                    $data["shipping_zip_code"]=$user_address->zip_code;
                    $data["shipping_phone_number_1"]=$user_address->phone_number_1;
                    $data["shipping_phone_number_2"]=$user_address->phone_number_2;
                    $data["shipping_email"]=$user_address->email;
                }else{
                    $data["shipping_name"]=$request->input("name");
                    $data["shipping_address_1"]=$request->input("address_1");
                    $data["shipping_address_2"]=$request->input("address_2");
                    $data["shipping_city"]=$request->input("city");
                    $data["shipping_state"]=$request->input("state");
                    $data["shipping_country"]=$request->input("country");
                    $data["shipping_zip_code"]=$request->input("zip_code");
                    $data["shipping_phone_number_1"]=$request->input("phone_number_1");
                    $data["shipping_phone_number_2"]=$request->input("phone_number_2");
                    $data["shipping_email"]=$request->input("email");
                }
            }
            elseif($address["address_type"]==2){
                if($address["user_address_id"]){
                    $address=$this->addresses->find($address["user_address_id"]);
                    $data["billing_name"]=$user_address->getFullName();
                    $data["billing_address_1"]=$user_address->address_1;
                    $data["billing_address_2"]=$user_address->address_2;
                    $data["billing_city"]=$user_address->city;
                    $data["billing_state"]=$user_address->state;
                    $data["billing_country"]=$user_address->country_id;
                    $data["billing_zip_code"]=$user_address->zip_code;
                    $data["billing_phone_number_1"]=$user_address->phone_number_1;
                    $data["billing_phone_number_2"]=$user_address->phone_number_2;
                    $data["billing_email"]=$user_address->email;
                }else{
                    $data["billing_name"]=$request->input("name");
                    $data["billing_address_1"]=$request->input("address_1");
                    $data["billing_address_2"]=$request->input("address_2");
                    $data["billing_city"]=$request->input("city");
                    $data["billing_state"]=$request->input("state");
                    $data["billing_country"]=$request->input("country");
                    $data["billing_zip_code"]=$request->input("zip_code");
                    $data["billing_phone_number_1"]=$request->input("phone_number_1");
                    $data["billing_phone_number_2"]=$request->input("phone_number_2");
                    $data["billing_email"]=$request->input("email");
                }
            }else{
                return redirect()->back()->with("error","Invalid Address");
            }
        }

        Session::put("vestidos_admin_shop",$data);
        return redirect()->route("admin_new_order_products");
        
    }
    public function editOrderAddress(Request $request, $order_id,$address_type_id){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order"]=$order;
        $address_var = $address_type_id==1? "Shipping" : "Billing";
        $data["order_id"]=$order_id;
        $data["address_var"]=$address_var;
        $data["page_title"]="Edit Order ".$address_var." Address";
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
        $address_var = $address_type_id==1? "shipping" : "billing";
        $data["order_id"]=$order_id;
        $data["address_var"]=$address_var;
        $data["page_title"]="Edit Order ".$address_var." Address";

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
            return redirect()->route("admin_edit_order",["order_id"=>$order_id])->with("success","address successfully saved");
        }
        return redirect()->back()->withErrors([
            "required"=>"unable to save"
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
                $subject = 'Hello '.$client_name.', your order has been updated';
                $message->to("evil_luis@hotmail.com","Admin")->subject($subject);
            });
        }
        return redirect()->route("admin_orders");
    }
    public function confirmCancel($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["cancel_reasons"]=$this->cancel_reasons->all();
        $data["page_title"]="Confirm Order Cancellation";
        return view("admin/orders/confirm",$data);
    }
    public function showAdminOrderPayment($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]="Process Order Payment";
        return view("admin/orders/payments/new",$data);
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
            $new_payment["transaction_id"]=$status->transaction->id;
            $new_payment["payment_method"]=$status->transaction->paymentInstrumentType;
            $new_payment["credit_card_type"]=$status->transaction->creditCard["cardType"];
            $new_payment["credit_card_number"]=$status->transaction->creditCard["last4"];
            $new_payment["payment_status"]=$status->transaction->processorResponseText;
            $new_payment["ip"]=$request->ip();
            $new_payment["created_at"]=carbon::now();
            $this->payment_histories->insert($new_payment);

            return redirect()->route('admin_edit_order',["order_id"=>$order_id])->with("success","payment completed");
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
                $subject = 'Hello '.$client_name.', your order is cancelled';
                $message->to("evil_luis@hotmail.com","Admin")->subject($subject);
            });
        }
        return redirect()->route("admin_orders")->with('success',"order successfully cancelled");
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
        $data["page_title"]="Confirm Order Delete";
        return view("admin/orders/confirm_delete",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        $order = $this->orders->find($order_id);
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user_id=$order->user_id;
        if($order->delete()){
            return redirect()->route("admin_orders")->with('success',"order successfully deleted");
        }
        return redirect()->route("admin_orders")->with('error',"order can't be deleted");
    }
}
