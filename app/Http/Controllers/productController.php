<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;

class productController extends Controller
{
    //
    public function index($product_id){
        $product = new Products();
        $product->find($produt_id);
        $data = [];
        $data["page_title"]="Product: ".$product->products_name;
        $data["product"]=$product;
        return view("product",$data);
    }
    public function searchByFilter(Request $request){
        $filter = $request->input("search_input");
        $product = new Products();
        $data=[];
        $data["products"]=$product->searchProductsByLabels($filter);
        return view("product",$data);
    }
}
