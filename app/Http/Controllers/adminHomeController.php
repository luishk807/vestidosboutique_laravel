<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class adminHomeController extends Controller
{
    //
    function home(){
        $data["page_title"]="Admin Home Page";
        return view("admin/home",$data);
    }
    public function signin(){
        $data=[];
        $data["page_title"]="Login";
        return view("admin/login",$data);
    }
    public function login(Request $request){
        $data=[];
        $data["page_title"]="Login";
        $data["email"]=$request->input("email");
        if($request->isMethod("post")){
            $this->validate($request,[
                "email"=>"required | email",
                "password"=>"required"
            ]);
            // if(Auth::guard("vestidosAdmins")->attempt([
            //     "email"=>$request->input("email"),
            //     "password"=>$request->input("password"),
            //     "user_type"=>2
            //     ])){
            //     $user_id=Auth::guard("vestidosAdmins")->user()->getId();
            //     $data["user_id"]=$user_id;
            //     return redirect()->route("admin");
            // }else{
            //     return redirect()->route('admin_show_login')->withInput($data)->with("msg","Invalid User");
            // }
            if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 2])) {
                $user_id=Auth::guard("vestidosAdmins")->user()->getId();
                $data["user_id"]=$user_id;
                return redirect()->route("admin");
            }else{
                return redirect()->route('admin_show_login')->withInput($data)->with("msg","Invalid User");
            }
        }
        return view("admin/login",$data);
    }
    protected function guard(){
        return auth()->guard('vestidosAdmins');
    }
    public function logout(){
        $data=[];
        if(Auth::guard("vestidosAdmins")->check()){
            Auth::guard("vestidosAdmins")->logout();
            return redirect()->route('login_page',$data);
        }
        return redirect()->back();
    }
}
