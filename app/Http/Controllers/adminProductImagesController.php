<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProductsImgs as Images;
use App\vestidosStatus as vestidosStatus;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use Illuminate\Support\Str;
use Excel;
use Session;
use Auth;
use DB;

class adminProductImagesController extends Controller
{
    //
    public function __construct(Products $products, vestidosStatus $vestidosStatus, Images $images){
        $this->statuses=$vestidosStatus;
        $this->images=$images;
        $this->products=$products;
        $this->maxWidth=1834;
        $this->maxHeight=2630;
    }
    public function index($product_id){
        $data=[];
        $product=$this->products->find($product_id);
        $data["page_submenus"]=[
            [
                "url"=>route('edit_product',['product_id'=>$product_id]),
                "name"=>"Back to Product"
            ],
            [
                "url"=>route('new_image',['product_id'=>$product_id]),
                "name"=>"Add Image"
            ]
            // ,
            // [
            //     "url"=>route('show_import_image',['product_id'=>$product_id]),
            //     "name"=>"Import Image"
            // ]
        ];
        $data["delete_menu"] =route('confirm_delete_images');
        $data["product_id"]=$product->id;
        $data["main_items"]=$product->images()->paginate(10);
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
                      //  if(($width ==$maxWidth) && ($height == $maxHeight)){
                            $picture =$this->getImageName($file,$product_id);
                            $destinationPath = public_path().'/images/products/';
                            $file->move($destinationPath, $picture);
                            $data["product_id"]=$product_id;
                            $data["img_url"]=$picture;
                            $data["created_at"]=carbon::now();
                            $this->images->insert($data);

                            // update modified and updated date
                            $guard = Session::get("guard");
                            if(Auth::guard(Session::get("guard"))->check()){
                                $session_user=Auth::guard(Session::get("guard"))->user()->getId();
                                $product = Products::find($product_id);
                                $product->modified_by = $session_user;
                                $product->updated_at = carbon::now();
                                $product->save();
                            }
                            //end
                        //}else{
                        //    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                        //}
                    }
                 }
            }
            return redirect()->route("admin_images",['product_id'=>$product_id]);
        }
        $data["required_size"]=[
            "width"=>$this->maxWidth,
            "height"=>$this->maxHeight
        ];
        $data["product_id"]=$product_id;
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
               // if(($width ==$maxWidth) && ($height == $maxHeight)){
                    $img_path =public_path().'/images/products/'.$image->img_url;
                    if(file_exists($img_path)){
                        @unlink($img_path);
                    }
                    $picture =$this->getImageName($file,$image->product_id);
                    $destinationPath =public_path().'/images/products/';
                    $file->move($destinationPath, $picture);
                    $image->img_url=$picture;
               // }else{
               //     return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
               // }
            }
            $image->img_name=$request->input("img_name");
            $image->status=(int)$request->input("status");
            $image->updated_at=carbon::now();

            $image->save();

            // update modified and updated date
            $guard = Session::get("guard");
            if(Auth::guard(Session::get("guard"))->check()){
                $session_user=Auth::guard(Session::get("guard"))->user()->getId();
                $product = Products::find($image->product_id);
                $product->modified_by = $session_user;
                $product->updated_at = carbon::now();
                $product->save();
            }
            //end

            return redirect()->route("admin_images",['product_id'=>$image->product_id]);
        }
        $data["product_id"]=$image->product_id;
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
    public function showImportImage($product_id){
        $data=[];
        $data["page_title"]="Import Images";
        $data["required_size"]=[
            "width"=>$this->maxWidth,
            "height"=>$this->maxHeight
        ];
        $data["product_id"]=$product_id;
        $data["import_btn"]="Import Images";
        return view("admin/products/images/import",$data);
    }

    public function saveImportImage(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $insert[]=[
                        "products_id"=>$value->product_id,
                        "img_name"=>$value->img_name,
                        "img_url"=>$value->img_url,
                        "status"=>1,
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Images::insert($insert);
                    // update modified and updated date
                    $guard = Session::get("guard");
                    if(Auth::guard(Session::get("guard"))->check()){
                        $session_user=Auth::guard(Session::get("guard"))->user()->getId();
                        $product = Products::find($value->product_id);
                        $product->modified_by = $session_user;
                        $product->updated_at = carbon::now();
                        $product->save();
                    }
                    //end
                    return redirect()->route('admin_products')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmImages(Request $request){
        $image_ids = $request["image_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "image_ids"=>"required",
        ],$custom_message);
        $images = $this->images->getImagesByIds($image_ids);
        $data["confirm_type"] = "img";
        $data["confirm_return"] = route("admin_images",["product_id"=>$images[0]->col_5]);
        $data["confirm_name"] = "Images";
        $data["confirm_data"] = $images;
        $data["confirm_delete_url"]=route('delete_images');
        $data["page_title"]="Confirm images for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteImages(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $image_ids = $request["item_ids"];
                foreach($image_ids as $image){
                   $image = $this->images->find($image);
                   $product_id = $image->product_id;
                   $img_path =public_path().'/images/products/'.$image->img_url;
                   if(file_exists($img_path)){
                        @unlink($img_path);
                    }
                    $image->delete();
                }
               return redirect()->route("admin_images",["product_id"=>$product_id])->with('success','Images Deleted successfully.');
    }
}
