<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminProductController extends Controller
{
    //
    function index(){
        $data=[];
        $data["page_title"]="Product Page";
        return view("admin/products",$data);
    }
    function createProducts(Request $request){
        $data=[];
        $data["page_title"]="Create Products Page";
        return view('admin/products/new',$data);
    }
    function newProducts(){
        $data=[];
        $data["page_title"]="Create Products Page";
        return view("admin/products/new",$data);
    }
    public function searchByFilter(Request $request){
        $filter = $request->input("search_input");
        $product = new Products();
        $data=[];
        $data["page_title"]="Search Product";
        $data["products"]=$product->searchProductsByLabels($filter);
        return view("admin/products/new",$data);
    }
}
