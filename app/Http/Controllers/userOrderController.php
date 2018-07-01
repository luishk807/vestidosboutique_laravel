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

class userOrderController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->users=$users;
        $this->products=$products;
        $this->addresses=$addresses;
    }
    public function index($user_id){
        $data=[];
        $data["orders"]=$this->orders->all();
        $data["user"]=$this->users->find($user_id);
        $data["page_title"]="Orders";
        return view("account/orders/home",$data);
    }
    public function viewOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["page_title"]="Order: ".$order->order_number;
        $data["order"]=$order;
        return view("account/orders/view",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        if($request->isMethod("post")){
            $order = $this->orders->find($order_id);
            return redirect()->route("user_account",["user_id"=>$order->user_id]);
        }
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]="Delete Orders";
        return view("account/orders/confirm",$data);
    }
}
