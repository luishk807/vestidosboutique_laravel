<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use App\vestidosStatus as Statuses;
use App\vestidosGenders as Genders;
use Carbon\Carbon as carbon;
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
                "password"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "gender"=>"required",
                "email"=>"required",
                "date_of_birth"=>"required",
                "preferred_language"=>"required",
                "status"=>"required",
            ]);
            $data["created_at"]=carbon::now();
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
    // public function updateUser(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
    // public function deleteUser(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
    // public function destroy(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
}
