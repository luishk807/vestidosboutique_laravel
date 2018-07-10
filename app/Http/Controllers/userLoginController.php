<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use Illuminate\Support\Facades\Auth;

class userLoginController extends Controller
{
    //
    public function __construct(Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
    }
    public function index(){
        $data["page_title"]="Login";
        $data["users"]=$this->users->all();
        return view("/signin",$data);
    }
    public function login(Request $request){
        $data["page_title"]="Login";
        $data["email"]=$request->input("email");
        if($request->isMethod("post")){
            $this->validate($request,[
                "email"=>"required | email",
                "password"=>"required"
            ]);
            if(Auth::guard("vestidosUsers")->attempt([
                "email"=>$request->input("email"),
                "password"=>$request->input("password"),
                "user_type"=>2
                ])){
                $user_id=Auth::guard("vestidosUsers")->user()->getId();
                $data["user_id"]=$user_id;
                return redirect('account/'.$user_id);
            }else{
                return redirect()->back()->withInput($data)->with("msg","Invalid User");
            }
        }
        return view("/signin",$data);
    }
    public function logout(){
        $data=[];
        $data["page_title"]="Login";
        if(Auth::guard("vestidosUsers")->check()){
            Auth::guard("vestidosUsers")->logout();
            return redirect()->route('login_page',$data);
        }
        return redirect()->back();
    }
}
