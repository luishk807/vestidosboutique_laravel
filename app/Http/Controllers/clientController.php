<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as vestidosUsers;
use App\vestidosCountries as vestidosCountries;

class clientController extends Controller
{
    //
    public function __construct(vestidosCountries $countries){
        $this->country=$countries->all();
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
    public function newClient(Request $request){
        $titles=array("Mr.","Mrs.","Ms.");
        $data["page_title"]="New Account";
        $data["countries"]=$this->country->all();
        $data["titles"]=$titles;

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
        return view("clientAccount/new",$data);
    }
    public function updateClient(Request $request){
        $titles=array("Mr.","Mrs.","Ms.");
        $data["page_title"]="Edit Account";
        $data["countries"]=$this->country->all();
        $data["titles"]=$titles;
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
        return view("clientAccount/edit",$data);
    }
}
