<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;

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
    public function searchByFilter(Request $request){
        $filter = $request->input("search_input");
        $product = new Products();
        $data=[];
        $data["products"]=$product->searchProductsByLabels($filter);
        return view("admin/products/newProduct",$data);
    }
}
