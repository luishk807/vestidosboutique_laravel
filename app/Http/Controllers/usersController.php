<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use Redirect;

class usersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
    }
    public function index(){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        if(Auth::guard("vestidosUsers")->check()){
            $user=$this->users->find($user_id);
            $data["page_title"]= __('general.page_header.welcome',["name"=>$user->getFullName()]);
            $data["user"]=$user;
            return view("account/home",$data);
        }
        $data["page_title"]="Login";
        return view('/signin',$data);
    }
    public function viewNewUser(Request $request){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["languages"]=$this->languages->all();
        $data["genders"]=$this->genders->all();
        $data["page_title"]=__('general.page_header.new_account');
        $data["countries"]=$this->country->all();
        return view("account/new",$data);
    }
    public function newUser(Request $request){
        $data=[];
        $this->validate($request,[
            "preferred_language"=>"required",
            "first_name"=>"required",
            "last_name"=>"required",
            "gender"=>"required",
            "password"=>"required | same:repassword",
            "repassword"=>"required | same:password",
            "date_of_birth"=>"required",
            "email"=>"required | email | unique:vestidos_users,email",
            "phone_number"=>"required",
        ]);
        
        $data["preferred_language"]=$request->input("preferred_language");
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["email"]=$request->input("email");
        $data["phone_number"]=$request->input("phone_number");
        $data["gender"]=$request->input("gender");
        $data["date_of_birth"]=$request->input("date_of_birth");
        
        $data["ip"]=$request->ip();
        $data["status"]=6;
        $data["user_type"]=1;
        $data["created_at"]=carbon::now();
        $data["password"]=Hash::make($request->input("password"));
        if($this->users->insert($data)){
            Mail::send('emails.usercreation_confirmation',["data"=>$data],function($message) use($data){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $data['first_name']." ".$data["last_name"];
                $subject = 'Hello '.$client_name.', your account registration is completed';
                $message->to($data["email"],$client_name)->subject($subject);
            });
            return redirect()->route('account_create_confirmed');
        }else{
            return redirect()->back();
        }
    }
    
    public function updateUser(Request $request){
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user=$this->users->find($user_id);
        $data["page_title"]=__('general.page_header.edit_account');
        $data["languages"]=$this->languages->all();
        $data["countries"]=$this->country->all();
        $data["user"]=$user;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["user_id"]=$user->id;
        if($request->isMethod("post")){
            $this->validate($request,[
                "preferred_language"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "password"=>"same:repassword",
                "email"=>"required | email | unique:vestidos_users,email,".$user_id,
                "phone_number"=>"required",
            ]);
            if(!empty($request->input("password"))){
                $user->password = Hash::make($request->input("password"));
            }
            $user->preferred_language=$request->input("preferred_language");
            $user->first_name=$request->input("first_name");
            $user->middle_name=$request->input("middle_name");
            $user->last_name=$request->input("last_name");
            $user->email=$request->input("email");
            $user->phone_number=$request->input("phone_number");
            $user->updated_at=carbon::now();
            $user->save();
            return redirect()->route("user_account",['user_id'=>$user->id]);
        }
        return view("account/edit",$data);
    }

}
