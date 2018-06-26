<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosColors as Colors;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosStatus as Statuses;


class adminColorController extends Controller
{
    //
    public function __construct(Colors $colors, Products $products, Statuses $statuses){
        $this->colors = $colors;
        $this->products = $products;
        $this->statuses = $statuses;
    }

    public function index($product_id){
        $data =[];
        $product=$this->products->find($product_id);
        $data["page_title"]="Colors For Product: ".$product->products_name;
        $data["product_id"]=$product_id;
        $data["colors"]=$this->colors->all();
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/products/colors/home",$data);
    }

    public function newColors($product_id,Request $request){
        $data =[];
        $product = $this->products->find($product_id);
        $data["product_id"]=$product_id;
        $data["name"]=$request->input("name");
        $data["color_code"]=$request->input("color_code");
        $data["status"]=$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "color_code"=>"required",
                "status"=>"required"
            ]);
            $data["created_at"]=carbon::now();
            $this->colors->insert($data);
            return redirect()->route("admin_colors",["product_id"=>$product_id]);
        }
        $data["page_title"]="New Color For ".$product->products_name;
        $data["product_id"]=$product_id;
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/products/colors/new",$data);
    }

    public function editColor($color_id, Request $request){
        $data =[];
        $data["page_title"]="Colors";
        $data["color"]=$this->colors->find($color_id);
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        $color=$this->colors->find($color_id);
        if($request->isMethod("post")){
            $color->name=$request->input("name");
            $color->color_code=$request->input("color_code");
            $color->status=(int)$request->input("status");
            $color->save();
            return redirect()->route("admin_colors",["product_id"=>$color->product_id]);
        }
        return view("admin/products/colors/edit",$data);
    }
    
    public function deleteColor($color_id, Request $request){
        $data =[];
        $color=$this->colors->find($color_id);
        if($request->input("_method")=="DELETE"){
            $color->delete();
            return redirect()->route("admin_colors",["product_id"=>$color->product_id]);
        }
        
        $data["page_title"]="Colors";
        $data["statuses"]=$this->statuses->all();
        $data["color"]=$color;
        $data["product_id"]=$color->product_id;
        return view("admin/products/colors/confirm",$data);
    }
}
