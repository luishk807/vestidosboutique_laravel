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

class ordersProductsController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->products=$products;
        $this->addresses=$addresses;
    }
    public function index(){
        $data=[];
        $data["orders"]=$this->orders->all();
        $data["page_title"]="Orders";
        return view("admin/orders/products/home",$data);
    }
    public function newOrderProducts($order_id,Request $request){
        $data=[];
        $data["order_id"]=$order_id;
        $data["status"]=(int)$request->input("status");
        $data["ip"]=$request->ip();
        $order_products=$request->input("order_products");
        $order_p=[];
        $data["order_products"]=$order_products;
        if($request->isMethod("post")){
            foreach($order_products as $product){
                if(!empty($product["id"])){
                    $order_p[]=[
                        "product_id"=>$product['product_id'],
                        "order_id"=>$order_id,
                        "quantity"=>$product['quantity'],
                        "status"=>"1",
                        "created_at"=>carbon::now()
                    ];
                }
            }
            $this->order_products->insert($order_p);
           return redirect()->route("admin_orders");
        }
        $order=$this->orders->find($order_id);
        $data["order"]=$order;
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Add Products To Order: ";
        return view("admin/orders/products/new",$data);
    }
    public function editOrderProduct($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["page_title"]="Edit Order";
        $data["order"]=$order;
        $data["order_id"]=$order_id;
        $data["status"]=(int)$request->input("status");
        $data["ip"]=$request->ip();
        if($request->isMethod("post")){
            $this->validate($request,[
                "status"=>"required",
            ]);
            $order->updated_at=carbon::now();
            $order->user_id=(int)$request->input("user");
            $order->status=(int)$request->input("status");
            $order->ip=$request->ip();


            $order->save();

            return redirect()->route("admin_orders");
        }
        $user=$this->users->find($order->user_id);
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Order";
        return view("admin/orders/products/edit",$data);
    }
    public function deleteOrderProduct($order_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $order = $this->orders->find($order_id);
            $order->delete();
            return redirect()->route("admin_orders");
        }
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]="Delete Orders";
        return view("admin/orders/products/confirm",$data);
    }
}
