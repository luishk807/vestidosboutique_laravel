<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use App\vestidosProductsRestocks as ProductRestocks;
use App\vestidosOrdersProducts as OrderProducts;
use App\vestidosProductRates as Rates;
use App\vestidosSizes as Sizes;
use App\vestidosLanguages as Languages;
use Auth;
use Session;
use Artisan;
use Illuminate\Support\Facades\DB;

class adminHomeController extends Controller
{
    //
    public function __construct(Languages $languages, Products $products, Orders $orders, Users $users, ProductRestocks $restocks, Rates $rates,Sizes $sizes,OrderProducts $order_products){
        $this->orders=$orders;
        $this->users=$users;
        $this->products=$products;
        $this->rates= $rates;
        $this->languages = $languages;
        $this->restocks = $restocks;
        $this->sizes = $sizes;
        $this->order_products = $order_products;
    }
    function home(){
        $data["page_title"]=__('header.admin_login');
        $data["orders"]=$this->orders->all();
        $data["products"]=$this->products->all();
        $data["users"]=$this->users->all();

        $data["restocks"]=$this->restocks->all();
        $data["rates"]=$this->rates->all();
        $data["languages"]=$this->languages->all();

        $data["unapproved_users"]=$this->users->getUnapprovedUsers();

        $data["last_ten_users"]=$this->users->getLatestTen();

        $order_year = $this->orders->getTotalOrderYear();
        $data["order_year"]=$order_year;

        $order_week = $this->orders->getTotalOrderWeek();
        $data["order_week"]=$order_week;

        $popular_dresses = $this->products->getPopularProduct();
        $data["popular_dresses"]=$popular_dresses;

        $product_stock = $this->sizes->where("stock","<",5)->limit(5)->get();
        $data["product_stocks"]=$product_stock;

        $data["user_genders"] = $this->users->getTotalGender();

        $unshipped_orders = $this->order_products->where("status","!=",3)->limit(10)->get();
        $data["unshipped_orders"]=$unshipped_orders;

        $data["age_ranges"]=$this->users->getRangeAges();

       //dd($data["order_week"]);
       return view("admin/home",$data);
    }
    public function signin(){
        $data=[];
        $data["page_title"]=__('header.admin_login');
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
            if (Auth::guard('vestidosAdmins')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' =>2])) {
                $user_id=Auth::guard("vestidosAdmins")->user()->getId();
                Session::put("guard","vestidosAdmins");
                Session::put("isAdmin",true);
                $data["user_id"]=$user_id;
                return redirect()->route("admin");
            }else if (Auth::guard('vestidosDataUsers')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' =>3])) {
                Session::put("guard","vestidosDataUsers");
                $user_id=Auth::guard("vestidosDataUsers")->user()->getId();
                Session::put("isAdmin",false);
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
        $guard = Session::get("guard");
        if(Auth::guard($guard)->check()){
            Auth::guard($guard)->logout();
            Session::flush();
            return redirect()->route('admin_show_login',$data)->with("msg","you are succefully logout");
        }
        return redirect()->back();
    }
    public function cacheClear(){
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return redirect()->back()->with("msg","Cached Cleared!");
    }
}
