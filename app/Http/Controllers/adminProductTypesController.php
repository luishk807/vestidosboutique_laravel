<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProductTypes as ProductTypes;
use App\vestidosStatus as VestidosStatus;
use Carbon\Carbon as carbon;
use Excel;


class adminProductTypesController extends Controller
{
    //
    public function __construct(ProductTypes $product_types,VestidosStatus $statuses){
        $this->product_types=$product_types;
        $this->statuses = $statuses;
    }
    public function index(){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('new_product_type'),
                "name"=>"Add Product Type"
            ],
            [
                "url"=>route('show_import_product_type'),
                "name"=>"Import Product Types"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_product_types');
        $data["page_title"]="ProductTypes";
        return view("admin/product_types/home",$data);
    }
    public function newproduct_types(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $data["name"] = $request->input("name");
            $data["category_id"] = $request->input("category");
            $data["status"] = (int)$request->input("status");
            $data["created_at"] = carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "category"=>"required",
                "status"=>"required"
            ]);
            $this->product_types->insert($data);
            return redirect()->route("admin_product_types");
        }
        $data["page_title"]="New ProductTypes";
        return view("admin/product_types/new",$data);
    }
    public function editproduct_type(Request $request,$product_type_id){
        $data=[];
        if($request->isMethod("post")){
            $product_type = $this->product_types->find($product_type_id);
            $product_type->name = $request->input("name");
            $product_type->category_id=$request->input("category");
            $product_type->updated_at =  carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "category"=>"required",
                "status"=>"required"
            ]);
            $product_type->save();
            return redirect()->route("admin_product_types");
        }
        $data["name"] = $request->input("name");
        $data["category"] = $request->input("category");
        $data["product_type"]=$this->product_types->find($product_type_id);
        $data["product_type_id"]=$product_type_id;
        $data["status"] = (int)$request->input("status");

        $data["page_title"]="Edit ProductTypes";
        return view("admin/product_types/edit",$data);
    }
    public function deleteproduct_type($product_type_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $product_type = $this->product_types->find($product_type_id);
            $product_type->delete();
            return redirect()->route("admin_product_types");
        }
        $data["page_title"]="Delete ProductTypes";
        $data["product_type"] = $this->product_types->find($product_type_id);
        $data["product_type_id"]=$product_type_id;
        return view("admin/product_types/confirm",$data);
    }

    public function showImportProductType(){
        $data=[];
        $data["page_title"]="Import ProductTypes";
        $data["import_btn"]="Import ProductTypes";
        return view("admin/product_types/import",$data);
    }

    public function saveImportProductType(Request $request){
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
                        "status"=>1,
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    ProductTypes::insert($insert);
                    return redirect()->route('admin_product_types')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmProductTypes(Request $request){
        $product_type_ids = $request["product_type_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "product_type_ids"=>"required",
        ],$custom_message);
        $product_types = $this->product_types->getProductTypesByIds($product_type_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_product_types");
        $data["confirm_name"] = "Product Types";
        $data["confirm_data"] = $product_types;
        $data["confirm_delete_url"]=route('delete_product_types');
        $data["page_title"]="Confirm product_types for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteProductTypes(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $product_type_ids = $request["item_ids"];
                foreach($product_type_ids as $product_type){
                   $product_type = $this->product_types->find($product_type);
                    $product_type->delete();
                }
               return redirect()->route("admin_product_types")->with('success','Product Types Deleted successfully.');
    }
}
