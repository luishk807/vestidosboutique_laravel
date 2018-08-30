<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosOrdersProducts as OrdersProducts;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;
use App\vestidosOrderCancelReasons as CancelReasons;
use Illuminate\Support\Facades\DB;
use App\vestidosShippingLists as ShippingLists;
use Mail;
use Auth;

class ordersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products,CancelReasons $cancel_reasons,ShippingLists $shippingLists){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->shipping_lists = $shippingLists;
        $this->cancel_reasons=$cancel_reasons;
        $this->products=$products;
        $this->addresses=$addresses;
    }
    public function index(){
        $data=[];
        $data["orders"]=$this->orders->all();
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
    public function newOrders(Request $request){
        $data=[];
        $user_id=(int)$request->input("user");
        $data["user_id"]=$user_id;
        $data["purchase_date"]=$request->input("purchase_date");
        $data["shipping_date"]=$request->input("shipping_date");
        $data["ship_address_id"]=(int)$request->input("ship_address");
        $data["bill_address_id"]=(int)$request->input("bill_address");
        $data["order_total"]=$request->input("order_total");
        $data["order_tax"]=$request->input("order_tax");
        $data["order_shipping"]=$request->input("order_shipping");
        $data["status"]=(int)$request->input("status");
        $ip=$request->ip();
        $data["ip"]=$ip;
        if($request->isMethod("post")){
            $this->validate($request,[
                "user"=>"required",
                "purchase_date"=>"required",
                "ship_address"=>"required",
                "bill_address"=>"required",
                "order_total"=>"required",
                "order_tax"=>"required",
                "order_shipping"=>"required",
                "status"=>"required"
            ]
            );
            $date = carbon::now();
            $data["created_at"]=$date;
            $time_converted =carbon::createFromFormat('Y-m-d H:i:s', $date)->format('YmdHise'); //get today date time
            $order_number = "VB".$time_converted."-".$user_id;
            $data["order_number"]=$order_number;
            $order = new Orders();
            $order_id=$order->insertGetId($data);

            return redirect()->route("admin_new_order_products",['order_id'=>$order_id]);
        }
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Order";
        return view("admin/orders/new",$data);
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
    public function saveOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order_id"]=$order_id;
        $data["purchase_date"]=$request->input("purchase_date");
        $data["shipping_date"]=$request->input("shipping_date");
        $data["order_quantity"]=(int)$request->input("order_quantity");
        $data["order_total"]=$request->input("order_total");
        $data["order_tax"]=$request->input("order_tax");
        $data["order_shipping"]=$request->input("order_shipping");
        $data["status"]=(int)$request->input("status");
        $data["ip"]=$request->ip();
        $this->validate($request,[
            "user"=>"required",
            "purchase_date"=>"required",
            "bill_address"=>"required",
            "order_quantity"=>"required",
            "order_total"=>"required",
            "order_tax"=>"required",
            "order_shipping"=>"required",
            "status"=>"required",
        ]);
        $order->updated_at=carbon::now();
        $order->user_id=(int)$request->input("user");
        $order->product_id=(int)$request->input("product");
        $order->purchase_date=$request->input("purchase_date");
        $order->shipping_date=$request->input("shipping_date");
        $order->ship_address_id=(int)$request->input("ship_address");
        $order->bill_address_id=(int)$request->input("bill_address");
        $order->order_quantity=(int)$request->input("order_quantity");
        $order->order_total=$request->input("order_total");
        $order->order_tax=$request->input("order_tax");
        $order->order_shipping=$request->input("order_shipping");
        $order->status=(int)$request->input("status");
        $order->ip=$request->ip();
        $order->save();
        return redirect()->route("admin_orders");
    }
    public function confirmDelete($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["cancel_reasons"]=$this->cancel_reasons->all();
        $data["page_title"]="Confirm Order Delete";
        return view("admin/orders/confirm",$data);
    }
    public function deleteOrder($order_id,Request $request){
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
                    "shipping_country"=>$order->shipping_country,
                    "shipping_zip_code"=>$order->shipping_zip_code,
                    "shipping_phone_number_1"=>$order->shipping_phone_number_1,
                    "shipping_phone_number_2"=>$order->shipping_phone_number_2,
                    "shipping_email"=>$order->shipping_email,
                    "billing_name"=>$order->billing_name,
                    "billing_address_1"=>$order->billing_address_1,
                    "billing_address_2"=>$order->billing_address_2,
                    "billing_city"=>$order->billing_city,
                    "billing_state"=>$order->billing_state,
                    "billing_country"=>$order->billing_country,
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
            Mail::send('emails.ordercancel_confirm',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = 'Hello '.$client_name.', your order is cancelled';
                $message->to("evil_luis@hotmail.com","Admin")->subject($subject);
            });
        }
        return redirect()->route("admin_orders")->with('success',"order successfully cancelled");
    }
}
