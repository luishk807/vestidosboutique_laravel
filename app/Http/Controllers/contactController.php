<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosCountries as vestidosCountries;

class contactController extends Controller
{
    //
    public function index(vestidosCountries $countries){
        $data["page_title"]="Contact Us";
        $data["countries"]=$countries->all();
        return view("contact",$data);
    }
    public function sendEmail(Request $request){
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "email"=>"required",
                "phone"=>"required",
                "country"=>"required",
                "question"=>"required"
            ]);
            $data = [
                'first_name'=>$request->input("first_name"),
                'last_name'=>$request->input("last_name"),
                'email'=>$request->input("email"),
                'phone'=>$request->input("phone"),
                'country'=>$request->input("country"),
                'message'=>$request->input("question")
            ];
            Mail::to('info@vestidosboutique.com')->send(new TestEmail($data));
           // return view("thankyou",["page_title"=>"Thank You"]);
        }
        return view("contact");
    }
}
