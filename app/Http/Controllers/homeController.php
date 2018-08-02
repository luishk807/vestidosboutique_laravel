<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestEmail;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as vestidosCountries;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosProducts as Products;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use App\vestidosConfigSectionMainSliders as MainSliders;
use Auth;
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
      $this->country=$countries->all();
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
        $data["page_title"]="Welcome Page";
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
        $data["page_title"]="About Us";
        return view("about",$data);
    }
    public function product($product_id){
        $data=[];
        $product = $this->products->find($product_id);
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["products_cat"]=$this->products->getProductByCat($product->category_id);
        $data["products"]=$this->products;
        $data["product"]=$product;
        $data["page_title"]="Product";
        return view("product",$data);
    }
    public function contact(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Contact Us";
        $data["countries"]=$this->country->all();
        return view("contact",$data);
    }
    public function sendEmail(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "email"=>"required",
                "phone"=>"required",
                "country"=>"required",
                "question"=>"required"
            ]);
            $first_name=$request->input("first_name");
            $last_name=$request->input("last_name");
            $email=$request->input("email");
            $phone=$request->input("phone");
            $country=$request->input("country");
            $message=$request->input("question");
            // $body_message = "Name: ".$first_name." ".$last_name."<br/>";
            // $body_message .= "Email: ".$email."<br/>";
            // $body_message .= "Phone: ".$phone."<br/>";
            // $body_message .= "Country: ".$country."<br/>";
            // $body_message .= "Message:<br/>";
            // $body_message .= $message;
            if($message != null)
             {   $datax = array('bodyMessage'=>"test");}
            else
            {$datax[]='';}
            Mail::send('email',$datax,function($message){
                $message->from('info@vestidosboutique.com','Just Laravel');
                $message->to("luishk807@hotmail.com")->subject('Just Laravel demo email using SendGrid');
            });
            return redirect()->route("viewContactPage")->withErrors(['Your email has been sent successfully']);
        }
        return view("contact");
    }
    public function signin(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Login";
        $data["users"]=$this->users->all();
        return view("/signin",$data);
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
            if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 1])) {
                $user_id=Auth::guard("vestidosUsers")->user()->getId();
                $data["user_id"]=$user_id;
                return redirect('account/'.$user_id);
            }else{
                return redirect()->back()->withInput($data)->with("msg","Invalid User");
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
            return redirect()->route('login_page',$data);
        }
        return redirect()->back();
    }
}
