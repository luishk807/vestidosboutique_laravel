<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosSizes as Sizes;
use Carbon\Carbon as carbon;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;
use Excel;

class adminSizesController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Sizes $sizes, Products $products){
        $this->statuses=$vestidosStatus;
        $this->sizes=$sizes;
        $this->products=$products;
    }
    public function index($product_id){
        $data=[];
        $product = $this->products->find($product_id);
        $data["sizes"]=$product->sizes()->get();
        $data["product_id"]=$product_id;
        $data["products"]=$this->products->all();
        $data["page_title"]="Dress Sizes";
        return view("admin/products/sizes/home",$data);
    }
    public function newSizes($product_id,Request $request){
        $data=[];
        $data["name"]=$request->input("size");
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
                "size"=>"required",
                "status"=>"required",
            ]
            );
            $data["product_id"]=$product_id;
            $data["created_at"]=carbon::now();
            $this->sizes->insert($data);
            return redirect()->route("admin_sizes",["product_id"=>$product_id]);
        }
        $product=$this->products->find($product_id);
        $data["size"]=(int)$request->input("size");
        $data["product_id"]=$product_id;
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Dress Size For: ".$product->products_name;
        return view("admin/products/sizes/new",$data);
    }
    public function editSize($size_id,Request $request){
        $data=[];
        $size =$this->sizes->find($size_id);
        $data["product_id"]=$size->product_id;
        $data["size"]=$size;
        $data["size_id"]=$size_id;
        $data["status"]=$request->input("status");
        $data["dress_size"]=$request->input("dress_size");
        if($request->isMethod("post")){
            $this->validate($request,[
                "dress_size"=>"required",
                "status"=>"required"
            ]);
            $size->name=$request->input("dress_size");
            $size->status=(int)$request->input("status");
            $size->updated_at=carbon::now();
            $size->save();

            return redirect()->route("admin_sizes",["product_id"=>$size->product_id]);
        }
        
        $data["statuses"]=$this->statuses->all();
        $product = $this->products->find($size->product_id);
        $data["page_title"]="Edit Dress Size For ".$product->products_name;
        return view("admin/products/sizes/edit",$data);
    }
    public function deleteSize($size_id,Request $request){
        $data=[];
        $size = $this->sizes->find($size_id);
        if($request->input("_method")=="DELETE"){
            $size->delete();
            return redirect()->route("admin_sizes",["product_id"=>$size->product_id]);
        }
        $data["size"]=$size;
        $data["page_title"]="Delete Dress Sizes ".$size->name;
        return view("admin/products/sizes/confirm",$data);
    }
    public function showImportSize($product_id){
        $data=[];
        $data["page_title"]="Import Sizes";
        $data["import_btn"]="Import Sizes";
        $data["product_id"]=$product_id;
        return view("admin/products/sizes/import",$data);
    }

    public function saveImportSize(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $insert[]=[
                        "product_id"=>$value->product_id,
                        "name"=>$value->name,
                        "status"=>1,
                        "ip"=>$request->ip(),
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Sizes::insert($insert);
                    $data["product_id"]=$request->input("product_id");
                    return redirect()->route('admin_sizes',$data)->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
}
