<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;

class usersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
    }
    public function index($user_id){
        $user=$this->users->find($user_id);
        $data["page_title"]="Welcome ".$user->getFullName();
        $data["user"]=$user;
        return view("account/home",$data);
    }
    public function login(Request $request){
        $data["page_title"]="Login";
        if($request->isMethod("post")){
            $this->validate($request,[
                "email"=>"required",
                "password"=>"required"
            ]);
            return redirect("signin");
        }
        return view("/signin",$data);
    }
    public function newUser(Request $request){
        $data=[];
        $data["preferred_language"]=$request->input("preferred_language");
        $data["user_name"]=$request->input("user_name");
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["email"]=$request->input("email");
        $data["phone_number"]=$request->input("phone_number");
        $data["gender"]=$request->input("gender");
        $data["date_of_birth"]=$request->input("date_of_birth");
        if($request->isMethod("post")){
            $this->validate($request,[
                "user_name"=>"required",
                "preferred_language"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "gender"=>"required",
                "password"=>"required | same:repassword",
                "repassword"=>"required | same:password",
                "date_of_birth"=>"required",
                "email"=>"required",
                "phone_number"=>"required",
            ]);
            $data["ip"]=$request->ip();
            $data["status"]=6;
            $data["user_type"]=1;
            $data["created_at"]=carbon::now();
            $this->users->insert($data);
            $last_id=$this->users->lastInsertId();
            $user = $this->users->find($last_id);
            $data["page_title"]="Welcome ".$user->getFullName();
            $data["user_id"]=$last_id;
            $data["user"]=$user;
            return redirect()->route("user_account",['user_id'=>$user->id]);
        }
        $data["languages"]=$this->languages->all();
        $data["genders"]=$this->genders->all();
        $data["page_title"]="New Account";
        $data["countries"]=$this->country->all();
        return view("account/new",$data);
    }
    public function updateUser($user_id, Request $request){
        $user=$this->users->find($user_id);
        $data["page_title"]="Edit Account";
        $data["languages"]=$this->languages->all();
        $data["countries"]=$this->country->all();
        $data["user"]=$user;
        $data["user_id"]=$user->id;
        if($request->isMethod("post")){
            $this->validate($request,[
                "user_name"=>"required",
                "preferred_language"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "password"=>"same:repassword",
                "email"=>"required",
                "phone_number"=>"required",
            ]);
            $user->preferred_language=$request->input("preferred_language");
            $user->user_name=$request->input("user_name");
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
