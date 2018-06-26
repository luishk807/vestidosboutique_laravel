<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProductsImgs as Images;
use App\vestidosStatus as vestidosStatus;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;

class adminProductImagesController extends Controller
{
    //
    public function __construct(Products $products, vestidosStatus $vestidosStatus, Images $images){
        $this->statuses=$vestidosStatus;
        $this->images=$images;
        $this->products=$products;
    }
    public function index($product_id){
        $data=[];
        $product=$this->products->find($product_id);
        $data["product_id"]=$product->id;
        $data["images"]=$product->images()->get();
        $data["page_title"]="Images For ".$product->products_name;
        return view("admin/products/images/home",$data);
    }
    public function newImages($product_id,Request $request){
        $data=[];
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                "status"=>"required"
             ]
            );


            $picture = '';
            $files = $request->file('image');
            if ($request->hasFile('image')) {
                foreach($files as $file){
                    if(!empty($file)){
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $picture = time().'.'.$filename;
                        $destinationPath = public_path().'/images/products/';
                        $file->move($destinationPath, $picture);
                        $data["product_id"]=$product_id;
                        $data["img_name"]=$picture;
                        $data["img_url"]=$destinationPath;
                        $data["created_at"]=carbon::now();
                        $this->images->insert($data);
                    }
                 }
            }
            return redirect()->route("admin_images",['product_id'=>$product_id]);
        }
        $data["product_id"]=$product_id;
        $product = $this->products->find($product_id);
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Image For Product: ".$product->products_name;
        return view("admin/products/images/new",$data);
    }
    public function editImage($image_id,Request $request){
        $data=[];
        $image =$this->images->find($image_id);
        $data["page_title"]="Edit Image ".$image->img_name;
        $data["image"]=$image;
        $data["image_id"]=$image_id;
        $data["name"]=$image->name;
        $data["status"]=$image->status;
        if($request->isMethod("post")){

            $this->validate($request,[
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                "status"=>"required"
             ]
            );


            $picture = '';
            $file = $request->file('image');
            if ($request->hasFile('image')) {
                $img_path =public_path().'/images/products/'.$image->img_name;
                if(file_exists($img_path)){
                    @unlink($img_path);
                }


                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = time().'.'.$filename;
                $destinationPath = public_path().'/images/products/';
                $file->move($destinationPath, $picture);
                $image->img_name=$picture;
                $image->img_url=$destinationPath;
            }
            
            $image->status=(int)$request->input("status");
            $image->updated_at=carbon::now();

            $image->save();

            return redirect()->route("admin_images",['product_id'=>$image->product_id]);
        }
        $data["product_id"]=$image->product_id;
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Image";
        return view("admin/products/images/edit",$data);
    }
    public function deleteImage($image_id,Request $request){
        $data=[];
        $image = $this->images->find($image_id);
        $img_path =public_path().'/images/products/'.$image->img_name;
        if($request->input("_method")=="DELETE"){
            if(file_exists($img_path)){
                @unlink($img_path);
                $image->delete();
            }
            return redirect()->route("admin_images",['product_id'=>$image->product_id]);
        }
        $data["image"]=$image;
        $data["product_id"]=$image->product_id;
        $data["page_title"]="Delete Images";
        return view("admin/products/images/confirm",$data);
    }
}
