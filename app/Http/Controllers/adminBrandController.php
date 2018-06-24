<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosBrands as vestidosBrands;
use App\vestidosStatus as vestidosStatus;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\DB;

class adminBrandController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, vestidosBrands $vestidosBrands){
        $this->statuses=$vestidosStatus;
        $this->brand=$vestidosBrands;
    }
    public function index(){
        $data=[];
        $data["brands"]=$this->brand->all();
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
            $data["created_at"]=carbon::now();
            $date["updated_at"]=carbon::now();
            $this->brand->insert($data);
            return redirect()->route("admin_brands");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Brand";
        return view("admin/brands/new",$data);
    }
    public function editBrand($brand_id,Request $request){
        $data=[];
        $brand =$this->brand->find($brand_id);
        $data["page_title"]="Edit Brand";
        $data["brand"]=$brand;
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
            $brand->status=(int)$request->input("status");
            $brand->updated_at=carbon::now();

            $brand->save();

            return redirect()->route("admin_brands");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Brand";
        return view("admin/brands/edit",$data);
    }
    public function deleteBrand($brand_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $brand = $this->brand->find($brand_id);
            $brand->delete();
            return redirect()->route("admin_brands");
        }
        $data["brand"]=$this->brand->find($brand_id);
        $data["page_title"]="Delete Brands";
        return view("admin/brands/confirm",$data);
    }
}
