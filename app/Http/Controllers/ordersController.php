<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;

class ordersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->users=$users;
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
        $data["user_id"]=$request->input("user");
        $data["product_id"]=$request->input("product");
        $data["purchase_date"]=$request->input("purchase_date");
        $data["shipping_date"]=$request->input("shipping_date");
        $data["ship_address_id"]=$request->input("ship_address_id");
        $data["bill_address_id"]=$request->input("bill_address_id");
        $data["order_quantity"]=$request->input("bill_address_id");
        $data["order_total"]=$request->input("order_total");
        $data["order_tax"]=$request->input("order_tax");
        $data["order_shipping"]=$request->input("order_shipping");
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
        
                "user"=>"required",
                "status"=>"required",
            ]
            );
            $data["created_at"]=carbon::now();
            $this->orders->insert($data);
            return redirect()->route("admin_orders");
        }
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        // $data["ship_addresses"] =$this->addresses->all();
        // $data["bill_addresses"] =$this->addresses->all();
        $data["page_title"]="New Order";
        return view("admin/orders/new",$data);
    }
    public function editOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["page_title"]="Edit Order";
        $data["order"]=$order;
        $data["order_id"]=$order_id;
        $data["name"]=$order->name;
        $data["status"]=$order->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $order =$this->orders->find($order_id);
            $order->name=$request->input("name");
            $order->status=(int)$request->input("status");
            $order->updated_at=carbon::now();

            $order->save();

            return redirect()->route("admin_orders");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Order";
        return view("admin/orders/edit",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $order = $this->orders->find($order_id);
            $order->delete();
            return redirect()->route("admin_orders");
        }
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]="Delete Orders";
        return view("admin/orders/confirm",$data);
    }
}
