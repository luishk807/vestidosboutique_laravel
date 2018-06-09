<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clientController extends Controller
{
    //
    public function login(Request $request){
        if($request->isMethod("post")){
            $this->validate($request,[
                "email"=>"required",
                "password"=>"required"
            ]);
            return redirect("signin");
        }
        return view("/signin",["page_title"=>"Login"]);
    }
    public function newClient(Request $request){
        $title=array("Mr.","Mrs.","Ms.");
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "email"=>"required",
                "phone"=>"required",
                "password"=>"required",
                "country"=>"required",
                "city"=>"required",
                "postal_code"=>"required"
            ]);
            return redirect("newclient");
        }
        return view("clientAccount/new",["page_title"=>"New Account","titles"=>$title]);
    }
    public function updateClient(Request $request){
        $title=array("Mr.","Mrs.","Ms.");
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "email"=>"required",
                "phone"=>"required",
                "password"=>"required",
                "country"=>"required",
                "city"=>"required",
                "postal_code"=>"required"
            ]);
            return redirect("editclient");
        }
        return view("clientAccount/edit",["page_title"=>"Edit Account","titles"=>$title]);
    }
}
