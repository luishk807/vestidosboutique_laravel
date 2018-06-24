<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosSizes as Sizes;
use Carbon\Carbon as carbon;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;

class adminSizesController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Sizes $sizes, Products $products){
        $this->statuses=$vestidosStatus;
        $this->sizes=$sizes;
        $this->products=$products;
    }
    public function index(){
        $data=[];
        $data["sizes"]=$this->sizes->all();
        $data["products"]=$this->products->all();
        $data["page_title"]="Dress Sizes";
        return view("admin/sizes/home",$data);
    }
    public function newDressTypes(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["products"]=$this->products->all();
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
        
                "name"=>"required",
                "status"=>"required",
            ]
            );
            $data["created_at"]=carbon::now();
            $date["updated_at"]=carbon::now();
            $this->sizes->insert($data);
            return redirect()->route("admin_sizes");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Dress Size";
        return view("admin/sizes/new",$data);
    }
    public function editDressType($size_id,Request $request){
        $data=[];
        $size =$this->sizes->find($size_id);
        $data["page_title"]="Edit Dress Size";
        $data["products"]=$this->products->all();
        $data["size"]=$size;
        $data["size_id"]=$size_id;
        $data["name"]=$size->name;
        $data["status"]=$size->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $size =$this->sizes->find($size_id);
            $size->name=$request->input("name");
            $size->status=(int)$request->input("status");
            $size->updated_at=carbon::now();

            $size->save();

            return redirect()->route("admin_sizes");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Dress Size";
        return view("admin/sizes/edit",$data);
    }
    public function deleteDressType($size_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $size = $this->sizes->find($size_id);
            $size->delete();
            return redirect()->route("admin_sizes");
        }
        $data["size"]=$this->sizes->find($size_id);
        $data["page_title"]="Delete Dress Sizes";
        return view("admin/sizes/confirm",$data);
    }
}
