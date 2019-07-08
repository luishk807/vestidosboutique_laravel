<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosConfigSectionMainSliders as MainSliders;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosStatus as vestidosStatus;
use Illuminate\Support\Str;

class adminConfigSectionMainSliders extends Controller
{
    //
    public function __construct(Products $products, vestidosStatus $vestidosStatus, MainSliders $main_sliders){
        $this->statuses=$vestidosStatus;
        $this->main_sliders=$main_sliders;
        $this->products=$products;
        $this->maxHeight=842;
        $this->maxWidth=1552;
    }
    public function index(){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('new_main_slider'),
                "name"=>"Add Slider"
            ]
        ];
        $data["main_sliders"]=$this->main_sliders->all();
        $data["page_title"]="Main Slider";
        return view("/admin/home_config/main_sliders/home",$data);
    }
    public function getMainSliderName($file){
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
    public function newMainSlider(Request $request){
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
                $picture =$this->getMainSliderName($file);
                if(($width ==$maxWidth) && ($height == $maxHeight)){
                    $destinationPath = public_path().'/images/main_sliders/';
                    $file->move($destinationPath, $picture);
                    $data["image_url"]=$picture;
                    $data["created_at"]=carbon::now();
                    $this->main_sliders->insert($data);
                }
                else{
                    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                }
            }
            return redirect()->route("main_sliders_page");
        }
        $data["page_title"]="New Slider";
        return view("/admin/home_config/main_sliders/new",$data);
    }
    public function editMainSlider($main_slider_id,Request $request){
        $data=[];
        $main_slider =$this->main_sliders->find($main_slider_id);
        $data["page_title"]="Edit Slider ".$main_slider->image_name;
        $data["main_slider"]=$main_slider;
        $data["image_name"]=$request->input("image_name");
        $data["image_name_2"]=$request->input("image_name_2");
        $data["image_destination"]=$request->input("image_destination");
        $regex='"/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/"';
        if($request->isMethod("post")){

            $this->validate($request,[
                'image_name' => 'required',
                'image_name_2' => 'required',
                'image_destination'=>'required | regex:'.$regex,
             ]
            );
            $file = $request->file('main_slider');
            if ($request->hasFile('image')) {
                $maxHeight=$this->maxHeight;
                $maxWidth=$this->maxWidth;
                list($width,$height) = getimagesize($file);
                $picture =$this->getMainSliderName($file);
                if(($width ==$maxWidth) && ($height == $maxHeight)){
                    if ($request->hasFile('main_slider')) {
                        $img_path =public_path().'/images/main_sliders/'.$main_slider->slider_img;
                        if(file_exists($img_path)){
                            @unlink($img_path);
                        }
                        $picture =$this->getMainSliderName($file);
                        $destinationPath = public_path().'/images/main_sliders/';
                        $file->move($destinationPath, $picture);
                        $main_slider->image_url=$picture;
                    }
                    $main_slider->image_name=$request->input("image_name");
                    $main_slider->image_name_2=$request->input("image_name_2");
                    $main_slider->image_destination = $request->input("image_destination");
                    $main_slider->updated_at=carbon::now();
        
                    $main_slider->save();
        
                    return redirect()->route("main_sliders_page",['product_id'=>$main_slider->product_id]);
                }
                else{
                    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                }
            }else{
                    $main_slider->image_name=$request->input("image_name");
                    $main_slider->image_name_2=$request->input("image_name_2");
                    $main_slider->image_destination = $request->input("image_destination");
                    $main_slider->updated_at=carbon::now();
                    $main_slider->save();
                    return redirect()->route("main_sliders_page",['product_id'=>$main_slider->product_id]);
            }

        }
        $data["page_title"]="Edit Slider";
        return view("/admin/home_config/main_sliders/edit",$data);
    }
    public function deleteMainSlider($main_slider_id,Request $request){
        $data=[];
        $main_slider = $this->main_sliders->find($main_slider_id);
        $img_path =public_path().'/images/main_sliders/'.$main_slider->image_url;
        if($request->input("_method")=="DELETE"){
            if(file_exists($img_path)){
                @unlink($img_path);
                $main_slider->delete();
            }
            return redirect()->route("main_sliders_page");
        }
        $data["main_slider"]=$main_slider;
        $data["page_title"]="Delete Slider";
        return view("/admin/home_config/main_sliders/confirm",$data);
    }
}
