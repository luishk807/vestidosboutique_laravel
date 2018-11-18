<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use App\vestidosProductsRestocks as ProductRestocks;
use App\vestidosProductRates as Rates;
use App\vestidosLanguages as Languages;
use Auth;
use Illuminate\Support\Facades\DB;

class adminHomeController extends Controller
{
    //
    public function __construct(Languages $languages, Products $products, Orders $orders, Users $users, ProductRestocks $restocks, Rates $rates){
        $this->orders=$orders;
        $this->users=$users;
        $this->products=$products;
        $this->rates= $rates;
        $this->languages = $languages;
        $this->restocks = $restocks;
    }
    function home(){
        $data["page_title"]="Admin Home Page";
        $data["orders"]=$this->orders->all();
        $data["products"]=$this->products->all();
        $data["users"]=$this->users->all();
        $data["restocks"]=$this->restocks->all();
        $data["rates"]=$this->rates->all();
        $data["languages"]=$this->languages->all();
        $order_data = DB::table('vestidos_orders as order')
        ->select(DB::raw("COUNT(*) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->get()->toArray();
        //dd($order_data);
        $order_data = array_column($order_data, 'count');
        $order_data = json_encode($order_data,JSON_NUMERIC_CHECK);
        $data["order_data"]=$order_data;
        return view("admin/home",$data);
    }
    public function signin(){
        $data=[];
        $data["page_title"]="Admin Login";
        return view("admin/login",$data);
    }
    public function login(Request $request){
        $data=[];
        $data["page_title"]="Login";
        $data["email"]=$request->input("email");
        if($request->isMethod("post")){
            $this->validate($request,[
                "email"=>"required | email",
                "password"=>"required"
            ]);
            // if(Auth::guard("vestidosAdmins")->attempt([
            //     "email"=>$request->input("email"),
            //     "password"=>$request->input("password"),
            //     "user_type"=>2
            //     ])){
            //     $user_id=Auth::guard("vestidosAdmins")->user()->getId();
            //     $data["user_id"]=$user_id;
            //     return redirect()->route("admin");
            // }else{
            //     return redirect()->route('admin_show_login')->withInput($data)->with("msg","Invalid User");
            // }
            if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 2])) {
                $user_id=Auth::guard("vestidosAdmins")->user()->getId();
                $data["user_id"]=$user_id;
                return redirect()->route("admin");
            }else{
                return redirect()->route('admin_show_login')->withInput($data)->with("msg","Invalid User");
            }
        }
        return view("admin/login",$data);
    }
    protected function guard(){
        return auth()->guard('vestidosAdmins');
    }
    public function logout(){
        $data=[];
        if(Auth::guard("vestidosAdmins")->check()){
            Auth::guard("vestidosAdmins")->logout();
            return redirect()->route('admin_show_login',$data)->with("msg","you are succefully logout");
        }
        return redirect()->back();
    }
}
