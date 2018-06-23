<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosColors as Colors;
use App\vestidosProducts as Products;
use App\vestidosStatus as Statuses;


class adminColorController extends Controller
{
    //
    public function __construct(Colors $colors, Products $products, Statuses $statuses){
        $this->colors = $colors;
        $this->products = $products;
        $this->statuses = $statuses;
    }

    public function index(){
        $data =[];
        $data["page_title"]="Colors";
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/colors/home",$data);
    }

    public function newColors(Request $request){
        $data =[];
        $data["page_title"]="New Colors";
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/colors/new",$data);
    }

    public function editColor($color_id, Request $request){
        $data =[];
        $data["page_title"]="Colors";
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/colors/edit/",$data);
    }
    
    public function deleteColor($color_id){
        $data =[];
        $data["page_title"]="Colors";
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/colors/confirm",$data);
    }
    public function destroy($color_id){
        $data =[];
        $data["page_title"]="Colors";
        $data["statuses"]=$this->statuses->all();
        $data["products"]=$this->products->all();
        return view("admin/colors/home",$data);
    }
}
