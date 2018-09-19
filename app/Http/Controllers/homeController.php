<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as vestidosCountries;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosProducts as Products;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use App\vestidosConfigSectionMainSliders as MainSliders;
use Auth;
use App;
use Mail;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users, MainSliders $main_sliders)
    {
      $this->brands=$brands;
      $this->country=$countries;
      $this->categories = $categories;
      $this->users = $users;
      $this->products=$products;
      $this->genders=$genders;
      $this->languages=$languages;
      $this->addresses=$addresses;
      $this->main_sliders = $main_sliders;
    }
    public function index()
    {
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]=__('general.page_header.welcome_page');
        $data["languages"]=$this->languages->all();
        $data["main_sliders"] = $this->main_sliders->all();
        $data["top_dresses"] = $this->products->where("top_dress","=",1)->get();
        $data["top_quinces"] = $this->products->where("top_quince","=",1)->get();
        $data["products"]=$this->products;
        return view("home",$data);
    }
    public function setLocale($lang)
    {
        App::setLocale($lang);
        Session::put("locale",$lang);
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]=__('general.page_header.welcome_page');
        $data["languages"]=$this->languages->all();
        $data["main_sliders"] = $this->main_sliders->all();
        $data["top_dresses"] = $this->products->where("top_dress","=",1)->get();
        $data["top_quinces"] = $this->products->where("top_quince","=",1)->get();
        $data["products"]=$this->products;
        return view("home",$data);
    }
    public function about(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]=__('header.about');
        return view("about",$data);
    }
    public function product($product_id){
        // $data=[];
        $product = $this->products->find($product_id);
        $product_cat = $this->products->getProductByCat($product->categories()->get()->first()->category_id);
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["products_cat"]=$product_cat;
        $data["products"]=$this->products;
        $data["product"]=$product;
        $data["page_title"]=__('header.product');
        return view("product",$data);
    }
    public function contact(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]=__('header.contact');
        $data["countries"]=$this->country->all();
        return view("contact",$data);
    }
    public function sendEmail(Request $request){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]=__('header.contact');
        $data["countries"]=$this->country->all();
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "email"=>"required",
                "phone"=>"required",
                "country"=>"required",
                "question"=>"required"
            ]);
            $client = [
                'first_name'=>$request->input("first_name"),
                'last_name'=>$request->input("last_name"),
                'email'=>$request->input("email"),
                'phone'=>$request->input("phone"),
                'country'=>$request->input("country"),
                'message'=>$request->input("question")
            ];
           Mail::send('emails.emailcontent',["client"=>$client],function($message) use($client){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $client['first_name']." ".$client["last_name"];
                $subject = __('general.user_section.to_user.thank_you',['name'=>$client_name]);
                $message->to($client["email"],$client_name)->subject($subject);
            });
            Mail::send('emails.adminemail',["client"=>$client],function($message) use($client){
                $client_name = $client['first_name']." ".$client["last_name"];
                $message->from($client["email"],$client_name);
                $subject = __('general.user_section.to_admin.thank_you',['name'=>$client_name]);
                $message->to("info@vestidosboutique.com","Admin")->subject($subject);
            });
            return view("thankyou.contact",$data);
        }
    }
    public function signin(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]=__('header.log_in');
        $data["users"]=$this->users->all();
        return view("/signin",$data);
    }
    public function login(Request $request){
        $data=[];
        $data["page_title"]=__('header.login');
        $data["email"]=$request->input("email");
        if($request->isMethod("post")){
            $this->validate($request,[
                "email"=>"required | email",
                "password"=>"required"
            ]);
            if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 1])) {
                $user_id=Auth::guard("vestidosUsers")->user()->getId();
                $data["user_id"]=$user_id;
                $user=$this->users->find($user_id);
                if($user->status !=1){
                    Auth::guard("vestidosUsers")->logout();
                    return redirect()->route("login_page")->with('activate_required',__('general.user_section.activation_required'));
                }
                if(!empty($user->preferred_language)){
                    $lang = $user->getLanguage->code;
                    App::setLocale($lang);
                    Session::forget("locale");
                    Session::put("locale",$lang);
                }
                return redirect()->route('user_account');
            }else{
                return redirect()->back()->withInput($data)->with("msg",__('auth.failed'));
            }
        }
        return view("/signin",$data);
    }
    protected function guard(){
        return auth()->guard('vestidosUsers');
    }
    public function logout(){
        $data=[];
        if(Auth::guard("vestidosUsers")->check()){
            Auth::guard("vestidosUsers")->logout();
            return redirect()->route('logout_confirmation');
        }else{
            $data["brands"]=$this->brands->all();
            $data["categories"]=$this->categories->all();
            $data["page_title"]=__('header.login');
            $data["users"]=$this->users->all();
            return redirect("/signin")->with($data);
        }
    }
}
