<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminUserLoginController extends Controller
{
    //
    public function __construction(){
        $this->middleware("guest");
    }
    public function login(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $this->validate($request,[
                "user_name"=>"required|min:2",
                "password"=>"required|min:6"
            ]);

        };
        return view("/signin",$data);
    }
}
