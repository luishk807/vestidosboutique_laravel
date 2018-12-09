<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosSizes as Sizes;
use Carbon\Carbon as carbon;
use App\vestidosVendors as Vendors;
use App\vestidosColors as Colors;
use App\vestidosProductsRestocks as ProductRestocks;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;
use Excel;

class adminSizesController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus,ProductRestocks $product_restocks, Sizes $sizes,  Vendors $vendors, Products $products,Colors $colors){
        $this->statuses=$vestidosStatus;
        $this->sizes=$sizes;
        $this->restocks = $product_restocks;
        $this->colors=$colors;
        $this->vendors=$vendors;
        $this->products=$products;
    }
    public function index($product_id){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('edit_product',['product_id'=>$product_id]),
                "name"=>"Back to Product"
            ],
            [
                "url"=>route('new_size',['product_id'=>$product_id]),
                "name"=>"Add Product Size"
            ],
            [
                "url"=>route('show_import_size',['product_id'=>$product_id]),
                "name"=>"Import Size"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_sizes');
        $product = $this->products->find($product_id);
        $data["main_items"]=$product->getAllSizes();
        $data["product_id"]=$product_id;
        $data["products"]=$this->products->all();
        $data["page_title"]="Dress Sizes For ".$product->products_name;
        return view("admin/products/sizes/home",$data);

    }
    public function newSizes($product_id,Request $request){
        $data=[];
        $data["name"]=$request->input("size");
        $data["color_id"]=$request->input("color");
        $data["stock"]=$request->input("stock");
        $data["status"]=(int)$request->input("status");
        $is_for_rent = $request->input("is_for_rent")?true:false;
        $data["is_rent"] = $is_for_rent;
        $data["total_rent"] = $is_for_rent?$request->input("total_rent"):0;
       
        $is_for_sell = $request->input("is_for_sale")?true:false;
        $data["is_sell"] = $is_for_sell;
        $data["total_sale"] = $is_for_sell?$request->input("total_sale"):0;

        if($request->isMethod("post")){
            $this->validate($request,[
                "size"=>"required",
                "status"=>"required",
                "color"=>"required",
                "stock"=>"required",
            ]
            );
            $data["created_at"]=carbon::now();
            $this->sizes->insert($data);
            return redirect()->route("admin_sizes",["product_id"=>$product_id]);
        }
        $product=$this->products->find($product_id);
        $data["size"]=(int)$request->input("size");
        $data["product_id"]=$product_id;
        $data["color"]=$request->input("color");

        $is_for_rent = $request->input("is_for_rent")?true:false;
        $data["is_rent"]=$is_for_rent;
        $data["total_rent"] = $is_for_rent?$request->input("total_rent"):0;

        $is_for_sell = $request->input("is_for_sale")?true:false;
        $data["is_sell"] = $is_for_sell;
        $data["total_sale"] = $is_for_sell?$request->input("total_sale"):0;

        $data["stock"]=$request->input("stock");
        $data["colors"]=$product->colors;
        $data["page_title"]="New Dress Size For: ".$product->products_name;
        return view("admin/products/sizes/new",$data);
    }
    public function editSize($size_id,Request $request){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('admin_products'),
                "name"=>"Back to Products"
            ]
        ];
        $size =$this->sizes->find($size_id);
        $color = $this->colors->find($size->color_id);
        $product = $this->products->find($color->product_id);
        $data["product_id"]=$color->product_id;
        $data["size"]=$size;
        $data["size_id"]=$size_id;
        $data["status"]=$request->input("status");
        $data["stock"]=$request->input("stock");
        $data["dress_size"]=$request->input("dress_size");
        $data["colors"]=$product->colors;
        $data["page_title"]="Edit Dress Size For ".$product->products_name;
        return view("admin/products/sizes/edit",$data);
    }
    public function saveSize($size_id,Request $request){
        $data=[];
        $size =$this->sizes->find($size_id);
        $color = $this->colors->find($size->color_id);
        $product = $this->products->find($color->product_id);
        $this->validate($request,[
            "dress_size"=>"required",
            "color"=>"required",
            "status"=>"required",
            "stock"=>"required",
            "total_rent"=>"required",
        ]);
        $size->name=$request->input("dress_size");
        
        $is_for_rent = $request->input("is_for_rent")?true:false;
        $size->is_rent=$is_for_rent;
        $size->total_rent = $is_for_rent?$request->input("total_rent"):0;

        $is_for_sell = $request->input("is_for_sale")?true:false;
        $size->is_sell = $is_for_sell;
        $size->total_sale = $is_for_sell?$request->input("total_sale"):0;


        if($size->total_rent != $request->input("total_rent")){
            $size->total_rent_old=$request->input("total_rent");
        }
        if($size->total_sale != $request->input("total_sale")){
            $size->total_sale_old=$request->input("total_sale");
        }


        $size->color_id=$request->input("color");
        $size->status=(int)$request->input("status");
        $size->updated_at=carbon::now();


        $size->save();

        return redirect()->route("admin_sizes",["product_id"=>$color->product_id]);
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
    public function deleteConfirmSizes(Request $request){
        $size_ids = $request["size_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "size_ids"=>"required",
        ],$custom_message);
        $sizes = $this->sizes->getSizesByIds($size_ids);
        $color = $this->sizes->getColor();
        $data["confirm_type"] = "name";
        // $data["confirm_return"] = route("admin_sizes",["product_id"=>$color->product_id]);
        $data["confirm_name"] = "Sizes";
        $data["confirm_data"] = $sizes;
        $data["confirm_delete_url"]=route('delete_sizes');
        $data["page_title"]="Confirm sizes for deletion";
      return view("admin/confirm_delete",$data);
    }
    public function deleteSizes(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $size_ids = $request["item_ids"];
                foreach($size_ids as $size){
                   $size = $this->sizes->find($size);
                    $size->delete();
                }
               return redirect()->route("admin_sizes")->with('success','Sizes Deleted successfully.');
    }
}
