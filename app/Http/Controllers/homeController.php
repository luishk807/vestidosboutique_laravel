<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ReCaptcha as ReCaptcha;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as vestidosCountries;
use App\vestidosProvinces as Provinces;
use App\vestidosDistricts as Districts;
use App\vestidosCorregimientos as Corregimientos;
use App\vestidosUsers as Users;
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use Carbon\Carbon as carbon;
use App\vestidosProducts as Products;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use App\vestidosConfigSectionMainSliders as MainSliders;
use Illuminate\Support\Facades\Input;
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

    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users, MainSliders $main_sliders,Sizes $sizes, Districts $districts, Provinces $provinces, Corregimientos $corregimientos,Colors $colors,ReCaptcha $recaptcha)
    {
      $this->recaptcha = $recaptcha;
      $this->brands=$brands;
      $this->country=$countries;
      $this->categories = $categories;
      $this->users = $users;
      $this->products=$products;
      $this->genders=$genders;
      $this->colors=$colors;
      $this->sizes=$sizes;
      $this->languages=$languages;
      $this->addresses=$addresses;
      $this->main_sliders = $main_sliders;
      $this->districts = $districts;
      $this->provinces = $provinces;
      $this->corregimientos = $corregimientos;
    }
    public function index()
    {
        $data=[];
        $data["page_title"]=__('general.page_header.welcome_page');
        $data["languages"]=$this->languages->all();
        $data["main_sliders"] = $this->main_sliders->all();
        $data["top_dresses"] = $this->products->where("top_dress","=",1)->get();
        $data["top_quinces"] = $this->products->where("top_quince","=",1)->get();
        $data["products"]=$this->products;
        return view("home",$data);
    }
    public function termsuse()
    {
        $data=[];
        $data["page_title"]=__('general.page_header.terms_use');
        $data["languages"]=$this->languages->all();
        return view("terms",$data);
    }
    public function privacyuse()
    {
        $data=[];
        $data["page_title"]=__('general.page_header.privacy_use');
        $data["languages"]=$this->languages->all();
        return view("privacy",$data);
    }
    public function setLocale($lang)
    {
        App::setLocale($lang);
        Session::put("locale",$lang);
        $data=[];
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
        $data["page_title"]=__('header.about');
        return view("about",$data);
    }
    public function product($product_id){
        // $data=[];
        $product = $this->products->find($product_id);
        $product_cat = $this->products->getProductByEvent($product->events()->get()->first()->event_id);
        $data["products_cat"]=$product_cat;
        $data["products"]=$this->products;
        $data["product"]=$product;
        $data["stock"]=$product->getStock()[0]->stock;
        $data["page_title"]=__('header.product');
        return view("product",$data);
    }
    public function contact(){
        $data=[];
        $data["page_title"]=__('header.contact');
        return view("contact",$data);
    }
    public function sendEmail(Request $request){
        $data=[];
        $data["page_title"]=__('header.contact');
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
           
            if($this->recaptcha->getResponse($request)){
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
                $data["thankyou_title"]=__('general.thank_you');
                $data["thankyou_msg"]=__('general.success_email');
                $data["thankyou_img"]="checked.svg";
                $data["page_title"]=__('header.confirmation');
                return view("/confirmation",$data);
            }
            return redirect()->back();
        }
    }
    public function howto(){
        $data=[];
        $data["page_title"]=__('header.how_to');
        return view("/howto",$data);
    }
    public function signin(){
        $data=[];
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
    public function loadStatesDrop(){
        $country_id=Input::get('data');
        $country = $this->country->find($country_id);
        return response()->json($country->provinces()->get());
    }
    public function loadDistrictsDrop(){
        $province_id=Input::get('data');
        $province = $this->provinces->find($province_id);
        return response()->json($province->districts()->get());
    }
    public function loadCorregimientosDrop(){
        $district_id=Input::get('data');
        $district = $this->districts->find($district_id);
        return response()->json($district->corregimientos()->get());
    }
    public function loadColor(){
        $product_id=Input::get('data');
        $product= $this->products->find($product_id);
        return response()->json($product->colors()->get());
    }
    public function loadSizeInfo(){
        $size_id=Input::get('data');
        $size = $this->sizes->find($size_id);
        if($size["stock"] > 0)
        {
            $size["stock_msg"]=__('general.product_title.in_stock');
        }
        else{
            $size["stock_msg"]=__('general.product_title.per_order');
        }
        return response()->json($size);
    }
    public function loadColorSizes(){
        $color_id=Input::get('data');
        if(!empty($color_id)){
            $color = $this->colors->find($color_id);
            $data["color"]["info"]=$color;
            $data["color"]["colors"]=$color->sizes()->get();
            return response()->json($data["color"]);
        }
    }
    public function loadProdQuantity(){
        $size_id=Input::get('data');
        
        $size = $this->sizes->find($size_id);
        return response()->json($size->stock);
    }
    public function loadProdQuantityData(){
        $size_id=Input::get('data');
        $size = $this->sizes->find($size_id);
        return response()->json(["stock"=>$size->stock,"total"=>$size->total_sale]);
    }
}
