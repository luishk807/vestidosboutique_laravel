<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use Auth;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;

class userOrderController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,Brands $brands,Categories $categories){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->users=$users;
        $this->products=$products;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
    }

    public function index(){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["orders"]=$user->orders()->paginate(2);
        $data["user"]=$user;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Orders";
        return view("account/orders/home",$data);
    }
    public function viewOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Order Detail";
        $data["order"]=$order;
        $data["user"]=$this->users->find($order->user_id);
        return view("account/orders/view",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        if($request->isMethod("post")){
            $order = $this->orders->find($order_id);
            return redirect()->route("user_account",["user_id"=>$order->user_id]);
        }
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]="Delete Orders";
        return view("account/orders/confirm",$data);
    }
}
