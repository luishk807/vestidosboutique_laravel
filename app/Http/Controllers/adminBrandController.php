<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosBrands as vestidosBrands;
use App\vestidosStatus as vestidosStatus;

class adminBrandController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, vestidosBrands $vestidosBrands){
        $this->statuses=$vestidosStatus;
        $this->brand=$vestidosBrands;
    }
    public function index(){
        $data=[];
        $data["page_title"]="Brands";
        return view("admin/brands/home",$data);
    }
    public function newBrands(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
        
                "name"=>"required",
                "status"=>"required",
            ]
            );
            $this->brand->insert($data);
            return redirect("brands");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Brand";
        return view("admin/brands/new",$data);
    }
    public function editBrand($brand_id,Request $request){
        $data=[];
        $brand =$this->brand->find($brand_id);
        $data["page_title"]="Edit Brand";
        $data["brand_id"]=$brand_id;
        $data["name"]=$brand->name;
        $data["status"]=$brand->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $brand =$this->brand->find($brand_id);
            $brand->name=$request->input("name");
            $brand->status=$request->input("status");
            
            $brand->save();

            return redirect("brands");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Brand";
        return view("admin/brands/edit",$data);
    }
    public function deleteBrand($brand_id){
        $brand = $this->brand->find($brand_id);
        $brand->delete();
    }
}
