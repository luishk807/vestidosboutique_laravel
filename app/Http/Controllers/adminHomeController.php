<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminHomeController extends Controller
{
    //
    function home(){

        return view("admin/content/home");
    }
}
