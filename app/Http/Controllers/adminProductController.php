<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminProductController extends Controller
{
    //
    function show(){

    }
    function createProducts(Request $request){
       
        return view('admin/products/newProduct');
    }
    function newProducts(){
        return view("admin/products/newProduct");
    }
}
