<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminHomeController extends Controller
{
    //
    function home(){
        $data["page_title"]="Login Page";
        return view("admin/home",$data);
    }
}
