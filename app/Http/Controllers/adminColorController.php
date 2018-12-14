<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosColors as Colors;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosStatus as Statuses;
use Excel;


class adminColorController extends Controller
{
    //
    public function __construct(Colors $colors, Products $products, Statuses $statuses){
        $this->colors = $colors;
        $this->products = $products;
        $this->statuses = $statuses;
    }

    public function index($product_id){
        $data =[];
        $product=$this->products->find($product_id);
        $data["page_submenus"]=[
            [
                "url"=>route('admin'),
                "name"=>"Home"
            ],
            [
                "url"=>route('admin_products'),
                "name"=>"Back to Products"
            ],
            [
                "url"=>route('new_color',['product_id'=>$product_id]),
                "name"=>"Add Color"
            ],
            [
                "url"=>route('show_import_color',['product_id'=>$product_id]),
                "name"=>"Import Color"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_colors');
        $data["page_title"]="Colors For Product: ".$product->products_name;
        $data["product_id"]=$product_id;
        $data["main_items"]=$product->colors()->paginate(10);
        $data["products"]=$this->products->all();
        return view("admin/products/colors/home",$data);
    }

    public function newColors($product_id,Request $request){
        $data =[];
        $product = $this->products->find($product_id);
        $data["product_id"]=$product_id;
        $data["name"]=$request->input("name");
        $data["color_code"]=$request->input("color_code");
        $data["status"]=$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "color_code"=>"required",
                "status"=>"required"
            ]);
            $data["created_at"]=carbon::now();
            $this->colors->insert($data);
            return redirect()->route("admin_colors",["product_id"=>$product_id]);
        }
        $data["page_title"]="New Color For ".$product->products_name;
        $data["product_id"]=$product_id;
        $data["products"]=$this->products->all();
        return view("admin/products/colors/new",$data);
    }

    public function editColor($color_id, Request $request){
        $data =[];
        $color=$this->colors->find($color_id);
        $data["color"]=$color;
        $data["products"]=$this->products->all();
        $data["page_submenus"]=[
            [
                "url"=>route('new_size',['product_id'=>$color->product_id]),
                "name"=>"Add Sizes"
            ]
        ];
        $data["page_title"]="Colors";

        $color=$this->colors->find($color_id);
        if($request->isMethod("post")){
            $color->name=$request->input("name");
            $color->color_code=$request->input("color_code");
            $color->status=(int)$request->input("status");
            $color->save();
            return redirect()->route("admin_colors",["product_id"=>$color->product_id]);
        }
        return view("admin/products/colors/edit",$data);
    }
    
    public function deleteColor($color_id, Request $request){
        $data =[];
        $color=$this->colors->find($color_id);
        if($request->input("_method")=="DELETE"){
            $color->delete();
            return redirect()->route("admin_colors",["product_id"=>$color->product_id]);
        }
        
        $data["page_title"]="Colors";
        $data["color"]=$color;
        $data["product_id"]=$color->product_id;
        return view("admin/products/colors/confirm",$data);
    }
    public function showImportColor($product_id){
        $data=[];
        $data["page_title"]="Import Colors";
        $data["product_id"]=$product_id;
        $data["import_btn"]="Import Colors";
        return view("admin/products/colors/import",$data);
    }

    public function saveImportColor(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $insert[]=[
                        "name"=>$value->name,
                        "color_code"=>$value->color_code,
                        "product_id"=>$value->product_id,
                        "status"=>1,
                        "ip"=>$request->ip(),
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    $data["product_id"]=$request->input("product_id");
                    Colors::insert($insert);
                    return redirect()->route('admin_colors',$data)->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmColors(Request $request){
        $color_ids = $request["color_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "color_ids"=>"required",
        ],$custom_message);
        $colors = $this->colors->getColorsByIds($color_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_colors");
        $data["confirm_name"] = "Colors";
        $data["confirm_data"] = $colors;
        $data["confirm_delete_url"]=route('delete_colors');
        $data["page_title"]="Confirm colors for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteColors(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $color_ids = $request["item_ids"];
                foreach($color_ids as $color){
                   $color = $this->colors->find($color);
                    $color->delete();
                }
               return redirect()->route("admin_colors")->with('success','Colors Deleted successfully.');
    }
}
