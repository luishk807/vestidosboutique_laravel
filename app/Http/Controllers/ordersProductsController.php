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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;
use Session;

class ordersProductsController extends Controller
{
    //
    public function __construct(Countries $countries, Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->countries=$countries;
        $this->products=$products;
        $this->addresses=$addresses;
    }
    public function index($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["orders"]=$this->orders->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Orders";
        return view("admin/orders/products/home",$data);
    }
    public function newOrderProducts(){
        $data=[];
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Add Products To Order: ";
        return view("admin/orders/products/new",$data);
    }
    public function createOrderProducts(Request $request){
        $data=[];
        if(Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with("error","Invalid access");
        }
        $order_products=$request->input("order_products");
        $order_p=[];
        foreach($order_products as $product){
            if(!empty($product["product_id"])){
                $order_p[]=[
                    "product_id"=>$product['product_id'],
                    "quantity"=>$product['quantity']
                ];
            }
        }
        $data["products"]=$order_p;
        // $this->order_products->insert($order_p);
        // return redirect()->route("admin_orders");

        dd($data);
    }
    public function editOrderProduct($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order_id"]=$order_id;
        $user=$this->users->find($order->user_id);
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Order";
        return view("admin/orders/products/edit",$data);
    }
    public function saveOrderProduct($order_id,Request $request){
        $data=[];
        $valid_array=false;
        $this->validate($request,[
            "order_product"=>"required"
        ]);
        $order_product = $request->input("order_product");
        foreach($order_product as $product){
            if(Arr::exists($product,"id")){
                $valid_array=true;
                $order_p = $this->order_products->find($product["id"]);
                $order_p->status=$product["status"];
                $order_p->save();
            }
        }
        if(!$valid_array){
            return redirect()->back()->withErrors(["required"=>"You must select a product"]);
        }else{
            return redirect()->route("admin_orders")->with("success","order updated");
        }
    }
    public function confirmDeleteOrderProduct($order_product_id){
        $data=[];
        $data["order"]=$this->orders->find($order_product->order_id);
        $data["order_product"]=$order_product;
        $data["page_title"]="Delete Product ".$order_product->getProduct->products_name." From Orders";
        return view("admin/orders/products/confirm",$data);
    }
    public function deleteOrderProduct($order_product_id,Request $request){
        $data=[];
        $order_product = $this->order_products->find($order_product_id);
        $order_product->delete();
        return redirect()->route("admin_orders"); 
    }
    public function editOrderAddress($order_id,$address_type){
        $data["order"]=$this->orders->find($order_id);
        $data["orders"]=$this->orders->all();
        $data["statuses"]=$this->statuses->all();
        $data["countries"]=$this->countries->all();
        $data["address_type"]=$address_type;
        $data["name"] = $request->input('address_name');
        $data["page_title"]="Orders Address";
        return view("admin/orders/addresses/new",$data);
    }
    public function saveOrderAddress($order_id,Request $request){
        $data=[];
        $order=$this->orders->find($order_id);
        $data["order"]=$order;
        $data["order_id"]=$order_id;
        return redirect()->route("admin_edit_order",$data);
    }
}
