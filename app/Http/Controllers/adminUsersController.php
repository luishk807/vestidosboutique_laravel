<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use App\vestidosStatus as Statuses;
use App\vestidosGenders as Genders;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Hash;
use App\vestidosLanguages as Languages;

class adminUsersController extends Controller
{
    //
    public function __construct(Genders $genders, Users $users, Statuses $statuses,Languages $languages){
        $this->users = $users;
        $this->statuses=$statuses;
        $this->languages=$languages;
        $this->genders = $genders;
    }
    public function userAddress($user_id){
        $data=[];
        $user = $this->users->find($user_id);
        $data["addresses"]=$user->getAddresses()->get();
        $data["user"]=$user;
        $data["user_id"]=$user_id;
        $data["page_title"]="Address Page For ".$user->getFullName();
        return view("admin/users/addresses/home",$data);
    }
    public function index(){
        $data = [];
        $data["page_title"]="Users";
        $data["users"]=$this->users->all();
        return view("admin/users/home",$data);
    }
    public function newUser(Request $request){
        $data = [];
        $data["user_name"]=$request->input("user_name");
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number"]=$request->input("phone_number");
        $data["email"]=$request->input("email");
        $data["date_of_birth"]=$request->input("date_of_birth");
        $data["gender"]=$request->input("gender");
        $data["preferred_language"]=$request->input("preferred_language");
        $data["status"]=(int)$request->input("status");
        $data["ip"]=$request->ip();
        if($request->isMethod("post")){
            $this->validate($request,[
                "user_name"=>"required",
                "password"=>"required | same:re-type_password",
                "first_name"=>"required",
                "last_name"=>"required",
                "gender"=>"required",
                "email"=>"required",
                "date_of_birth"=>"required",
                "preferred_language"=>"required",
                "status"=>"required",
            ]);
            $data["created_at"]=carbon::now();
            $data["password"]=Hash::make($request->input("password"));
            $this->users->insert($data);
            return redirect()->route("admin_users");
        }
        $data["page_title"]="New Users";
        $data["genders"] = $this->genders->all();
        $data["statuses"]=$this->statuses->all();
        $data["users"]=$this->users->all();
        $data["languages"]=$this->languages->all();
        return view("admin/users/new",$data);
    }
    function updateUser($user_id, Request $request){
        $data=[];
        $data["user_name"]=$request->input("user_name");
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number"]=$request->input("phone_number");
        $data["email"]=$request->input("email");
        $data["gender"]=$request->input("gender");
        $data["preferred_language"]=$request->input("preferred_language");
        $data["date_of_birth"]=$request->input("date_of_birth");
        $data["status"]=(int)$request->input("status");
        $user = $this->users->find($user_id);
        if($request->isMethod("post")){
            $this->validate($request,[
                "user_name"=>"required",
                "first_name"=>"required",
                "password" => "same:re-type_password",
                "last_name"=>"required",
                "phone_number"=>"required",
                "email"=>"required",
                "date_of_birth"=>"required",
                "gender"=>"required",
                "preferred_language"=>"required",
                "status"=>"required"
            ]);
            $user->user_name = $request->input("user_name");
            if(!empty($request->input("password"))){
                $user->password = Hash::make($request->input("password"));
            }
            $user->first_name = $request->input("first_name");
            $user->middle_name = $request->input("middle_name");
            $user->last_name = $request->input("last_name");
            $user->phone_number = $request->input("phone_number");
            $user->email = $request->input("email");
            $user->date_of_birth = $request->input("date_of_birth");
            $user->gender = (int)$request->input("gender");
            $user->preferred_language = (int)$request->input("preferred_language");
            $user->status = (int)$request->input("status");
            $user->updated_at = carbon::now();
            $user->save();
            return redirect()->route("admin_users");
        }
        $data["user"]=$user;
        $data["page_title"]="Edit Users";
        $data["user_id"]=$user_id;
        $data["statuses"]=$this->statuses->all();
        $data["languages"]=$this->languages->all();
        $data["genders"]=$this->genders->all();
        return view("admin/users/edit",$data);
    }
    public function deleteUser($user_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $user = $this->users->find($user_id);
            $user->delete();
            return redirect()->route("admin_users");
        }
        $data["user"]=$this->users->find($user_id);
        $data["page_title"]="Delete User";
        return view("admin/users/confirm",$data);
    }
}
