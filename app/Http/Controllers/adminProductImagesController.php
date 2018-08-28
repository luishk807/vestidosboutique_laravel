<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProductsImgs as Images;
use App\vestidosStatus as vestidosStatus;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use Illuminate\Support\Str;

class adminProductImagesController extends Controller
{
    //
    public function __construct(Products $products, vestidosStatus $vestidosStatus, Images $images){
        $this->statuses=$vestidosStatus;
        $this->images=$images;
        $this->products=$products;
        $this->maxHeight=1666;
        $this->maxWidth=1000;
    }
    public function index($product_id){
        $data=[];
        $product=$this->products->find($product_id);
        $data["product_id"]=$product->id;
        $data["images"]=$product->images()->get();
        $data["page_title"]="Images For ".$product->products_name;
        return view("admin/products/images/home",$data);
    }
    public function getImageName($file,$product_id){
        $picture="";
        $date = carbon::now();
        $time_converted =carbon::createFromFormat('Y-m-d H:i:s', $date)->format('YmdHise'); //get today date time
        $filename = Str::lower($file->getClientOriginalName());
        $filename = pathinfo($filename, PATHINFO_FILENAME); // file
        $extension = $file->getClientOriginalExtension();
        $filename = preg_replace("![^a-z0-9]+!i", "-", $filename);
        $filename = $filename.".".$extension;
        $picture = $time_converted.'-'.$product_id."-".$filename;

        return $picture;
    }
    public function newImages($product_id,Request $request){
        $data=[];
        $data["status"]=(int)$request->input("status");
        $product = $this->products->find($product_id);
        if($request->isMethod("post")){
            $this->validate($request,[
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                "status"=>"required"
             ]
            );
            $files = $request->file('image');
            if ($request->hasFile('image')) {
                foreach($files as $file){
                    if(!empty($file)){
                        $maxHeight=$this->maxHeight;
                        $maxWidth=$this->maxWidth;
                        list($width,$height) = getimagesize($file);
                        if(($width ==$maxWidth) && ($height == $maxHeight)){
                            $picture =$this->getImageName($file,$product_id);
                            $destinationPath = public_path().'/images/products/';
                            $file->move($destinationPath, $picture);
                            $data["product_id"]=$product_id;
                            $data["img_url"]=$picture;
                            $data["created_at"]=carbon::now();
                            $this->images->insert($data);
                        }else{
                            return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                        }
                    }
                 }
            }
            return redirect()->route("admin_images",['product_id'=>$product_id]);
        }
        $data["product_id"]=$product_id;
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
                'img_name' => 'required',
                "status"=>"required"
             ]
            );
            $file = $request->file('image');
            if ($request->hasFile('image')) {
                $maxHeight=$this->maxHeight;
                $maxWidth=$this->maxWidth;
                list($width,$height) = getimagesize($file);
                if(($width ==$maxWidth) && ($height == $maxHeight)){
                    $img_path =public_path().'/images/products/'.$image->img_url;
                    if(file_exists($img_path)){
                        @unlink($img_path);
                    }
                    $picture =$this->getImageName($file,$image->product_id);
                    $destinationPath = public_path().'/images/products/';
                    $file->move($destinationPath, $picture);
                    $image->img_url=$picture;
                }else{
                    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                }
            }
            $image->img_name=$request->input("img_name");
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
        $img_path =public_path().'/images/products/'.$image->img_url;
        if($request->input("_method")=="DELETE"){
            if(file_exists($img_path)){
                @unlink($img_path);
                $image->delete();
            }
            return redirect()->route("admin_images",['product_id'=>$image->product_id]);
        }
        $data["image"]=$image;
        $data["image_id"]=$image->id;
        $data["product_id"]=$image->product_id;
        $data["page_title"]="Delete Images";
        return view("admin/products/images/confirm",$data);
    }
}
