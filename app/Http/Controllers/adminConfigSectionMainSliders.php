<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosConfigSectionMainSliders as MainSliders;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosStatus as vestidosStatus;

class adminConfigSectionMainSliders extends Controller
{
    //
    public function __construct(Products $products, vestidosStatus $vestidosStatus, MainSliders $main_sliders){
        $this->statuses=$vestidosStatus;
        $this->main_sliders=$main_sliders;
        $this->products=$products;
    }
    public function index(){
        $data=[];
        $data["main_sliders"]=$this->main_sliders->all();
        $data["page_title"]="Main Slider";
        return route("main_sliders_page",$data);
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
                'main_slider' => 'required',
                'main_slider.*' => 'main_slider|mimes:jpeg,png,jpg,gif,svg|max:2048'
             ]
            );
            $files = $request->file('main_slider');
            if ($request->hasFile('main_slider')) {
                foreach($files as $file){
                    if(!empty($file)){
                        $picture =$this->getMainSliderName($file);
                        $destinationPath = public_path().'/images/main_sliders/';
                        $file->move($destinationPath, $picture);
                        $data["image_url"]=$picture;
                        $data["created_at"]=carbon::now();
                        $this->main_sliders->insert($data);
                    }
                 }
            }
            return redirect()->route("main_sliders_page");
        }
        $data["page_title"]="New Slider";
        return route("new_main_slider",$data);
    }
    public function editMainSlider($main_slider_id,Request $request){
        $data=[];
        $main_slider =$this->main_sliders->find($main_slider_id);
        $data["page_title"]="Edit Slider ".$main_slider->image_name;
        $data["main_slider"]=$main_slider;
        $data["image_name"]=$request->input("image_name");
        $data["image_destination"]=$request->input("image_destination");
        if($request->isMethod("post")){

            $this->validate($request,[
                'image_name' => 'required',
                'image_destination'=>'required'
             ]
            );
            $file = $request->file('main_slider');
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
            $main_slider->image_destination = $request->input("image_destination");
            $main_slider->updated_at=carbon::now();

            $main_slider->save();

            return redirect()->route("main_sliders_page",['product_id'=>$main_slider->product_id]);
        }
        $data["page_title"]="Edit Slider";
        return route("edit_main_slider",$data);
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
        return route("confirm_main_slider",$data);
    }
}
