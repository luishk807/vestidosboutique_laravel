<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosConfigSectionShopBanners as ShopBanners;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosStatus as vestidosStatus;
use Illuminate\Support\Str;

class adminConfigShopBannerController extends Controller
{
    //
    public function __construct(Products $products, vestidosStatus $vestidosStatus, ShopBanners $shop_banners){
        $this->statuses=$vestidosStatus;
        $this->shop_banners=$shop_banners;
        $this->products=$products;
        $this->maxHeight=244;
        $this->maxWidth=834;
    }
    public function index(){
        $data=[];
        $data["shop_banners"]=$this->shop_banners->all();
        $data["page_title"]="Shop Banners";
        return view("/admin/home_config/shop_banners/home",$data);
    }
    public function getShopBannerName($file){
        $picture="";
        $date = carbon::now();
        $time_converted =carbon::createFromFormat('Y-m-d H:i:s', $date)->format('YmdHise'); //get today date time
        $filename = Str::lower($file->getClientOriginalName());
        $filename = pathinfo($filename, PATHINFO_FILENAME); // file
        $extension = $file->getClientOriginalExtension();
        $filename = preg_replace("![^a-z0-9]+!i", "-", $filename);
        $filename = $filename.".".$extension;
        $picture = $time_converted."-".$filename;

        return $picture;
    }
    public function newShopBanner(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $this->validate($request,[
                'image' => 'required|image|mimes:jpeg,jpg|max:2048'
             ]
            );
            $file = $request->file('image');
            if ($request->hasFile('image')) {

                $maxHeight=$this->maxHeight;
                $maxWidth=$this->maxWidth;
                list($width,$height) = getimagesize($file);
                $picture =$this->getShopBannerName($file);
                if(($width ==$maxWidth) && ($height == $maxHeight)){
                    $destinationPath = public_path().'/images/shop_banners/';
                    $file->move($destinationPath, $picture);
                    $data["image_url"]=$picture;
                    $data["created_at"]=carbon::now();
                    $this->shop_banners->insert($data);
                }
                else{
                    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                }
            }
            return redirect()->route("shop_banners_page");
        }
        $data["page_title"]="New Banner";
        return view("/admin/home_config/shop_banners/new",$data);
    }
    public function editShopBanner($shop_banner_id,Request $request){
        $data=[];
        $shop_banner =$this->shop_banners->find($shop_banner_id);
        $data["page_title"]="Edit Banner ".$shop_banner->image_name;
        $data["shop_banner"]=$shop_banner;
        $data["image_name"]=$request->input("image_name");
        $data["image_destination"]=$request->input("image_destination");
        $regex='"/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/"';
        if($request->isMethod("post")){

            $this->validate($request,[
                'image_name' => 'required',
                'image_destination'=>'required | regex:'.$regex,
             ]
            );
            $file = $request->file('shop_banner');

                if ($request->hasFile('shop_banner')) {
                    $maxHeight=$this->maxHeight;
                    $maxWidth=$this->maxWidth;
                    list($width,$height) = getimagesize($file);
                    $picture =$this->getShopBannerName($file);
                    if(($width ==$maxWidth) && ($height == $maxHeight)){
                        $img_path =public_path().'/images/shop_banners/'.$shop_banner->slider_img;
                        if(file_exists($img_path)){
                            @unlink($img_path);
                        }
                        $picture =$this->getShopBannerName($file);
                        $destinationPath = public_path().'/images/shop_banners/';
                        $file->move($destinationPath, $picture);
                        $shop_banner->image_url=$picture;
                    }
                    else{
                        return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                    }
                }
                $shop_banner->image_name=$request->input("image_name");
                $shop_banner->image_destination = $request->input("image_destination");
                $shop_banner->updated_at=carbon::now();
    
                $shop_banner->save();
    
                return redirect()->route("shop_banners_page",['product_id'=>$shop_banner->product_id]);
            
        }
        $data["page_title"]="Edit Banner";
        return view("/admin/home_config/shop_banners/edit",$data);
    }
    public function deleteShopBanner($shop_banner_id,Request $request){
        $data=[];
        $shop_banner = $this->shop_banners->find($shop_banner_id);
        $img_path =public_path().'/images/shop_banners/'.$shop_banner->image_url;
        if($request->input("_method")=="DELETE"){
            if(file_exists($img_path)){
                @unlink($img_path);
                $shop_banner->delete();
            }
            return redirect()->route("shop_banners_page");
        }
        $data["shop_banner"]=$shop_banner;
        $data["page_title"]="Delete Banner";
        return view("/admin/home_config/shop_banners/confirm",$data);
    }
}
