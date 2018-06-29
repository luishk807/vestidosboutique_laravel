<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;
use App\vestidosCategories as Categories;
use App\vestidosClosureTypes as Closures;
use App\vestidosColors as Colors;
use App\vestidosBrands as Brands;
use App\vestidosFitTypes as Fits;
use App\vestidosFabricTypes as Fabrics;
use App\vestidosSizes as Sizes;
use App\vestidosProductsImgs as Images;
use App\vestidosVendors as Vendors;
use App\vestidosNecklineTypes as Necklines;
use App\vestidosWaistlineTypes as Waistlines;
use Carbon\Carbon as carbon;
use File;

class adminProductController extends Controller
{
    //
    public function __construct(Images $images, vestidosStatus $vestidosStatus, Products $products,Categories $categories, Closures $closures,Colors $colors, Brands $brands, Fits $fits, Fabrics $fabrics, Sizes $sizes,  Vendors $vendors, Necklines $necklines, Waistlines $waistlines){
        $this->statuses=$vestidosStatus;
        $this->products=$products;
        $this->categories=$categories;
        $this->closures=$closures;
        $this->colors=$colors;
        $this->brands=$brands;
        $this->fits=$fits;
        $this->fabrics=$fabrics;
        $this->sizes=$sizes;
        $this->vendors=$vendors;
        $this->necklines=$necklines;
        $this->waistlines=$waistlines;
        $this->images = $images;
    }
    function index(){
        $data=[];
        $data["products"]=$this->products->all();
        $data["page_title"]="Product Page";
        return view("admin/products/home",$data);
    }
    function newProducts(Request $request){
        $data=[];


        $data["products_name"]=$request->input("products_name");
        $data["brand_id"]=(int)$request->input("brand");
        $data["vendor_id"]=(int)$request->input("vendor");
        $data["category_id"]=(int)$request->input("category");
        $data["product_closure_id"]=(int)$request->input("closure");
        $data["product_fabric_id"]=(int)$request->input("fabric");
        $data["product_fit_id"]=(int)$request->input("fit");
        $data["product_neckline_id"]=(int)$request->input("neckline");
        $data["product_waistline_id"]=(int)$request->input("waistline");
        $data["product_total"]=$request->input("product_total");
        $data["product_stock"]=$request->input("product_stock");
        $data["search_labels"]=$request->input("search_labels");
        $data["product_detail"]=$request->input("product_detail");
        $data["products_description"]=$request->input("products_description");
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
                "products_name"=>"required",
                "status"=>"required",
                "brand"=>"required",
                "category"=>"required",
                "closure"=>"required",
                "fabric"=>"required",
                "fit"=>"required",
                "neckline"=>"required",
                "waistline"=>"required",
                "products_description"=>"required",
                "product_total"=>"required",
                "product_stock"=>"required"
            ]);
            $data["created_at"]=carbon::now();
            $this->products->insert($data);
            return redirect()->route("admin_products");
        }
        $data["brand"]=(int)$request->input("brand");
        $data["vendor"]=(int)$request->input("vendor");
        $data["category"]=(int)$request->input("category");
        $data["closure"]=(int)$request->input("closure");
        $data["fabric"]=(int)$request->input("fabric");
        $data["fit"]=(int)$request->input("fit");
        $data["neckline"]=(int)$request->input("neckline");
        $data["waistline"]=(int)$request->input("waistline");

        $data["page_title"]="Create Products Page";
        $data["statuses"]=$this->statuses->all();
        $data["categories"]=$this->categories->all();
        $data["closures"]=$this->closures->all();
        $data["brands"]=$this->brands->all();   
        $data["fits"]=$this->fits->all();
        $data["fabrics"]=$this->fabrics->all();
        $data["vendors"]=$this->vendors->all();
        $data["necklines"]=$this->necklines->all();
        $data["waistlines"]=$this->waistlines->all();
        return view("admin/products/new",$data);
    }
    function editProduct($product_id, Request $request){
        $data=[];
        $data["products_name"]=$request->input("products_name");
        $data["product_total"]=$request->input("product_total");
        $data["product_stock"]=$request->input("product_stock");
        $data["search_labels"]=$request->input("search_labels");
        $data["product_detail"]=$request->input("product_detail");
        $data["products_description"]=$request->input("products_description");
        $data["status"]=(int)$request->input("status");
        $product = $this->products->find($product_id);
        if($request->isMethod("post")){
            $this->validate($request,[
                "products_name"=>"required",
                "status"=>"required",
                "brand"=>"required",
                "category"=>"required",
                "closure"=>"required",
                "fabric"=>"required",
                "fit"=>"required",
                "neckline"=>"required",
                "waistline"=>"required",
                "products_description"=>"required",
                "product_total"=>"required",
                "product_stock"=>"required"
            ]);
            $product->products_name = $request->input("products_name");
            $product->brand_id = (int)$request->input("brand");
            $product->vendor_id = (int)$request->input("vendor");
            $product->category_id = (int)$request->input("category");
            $product->product_closure_id = (int)$request->input("closure");
            $product->product_fabric_id = (int)$request->input("fabric");
            $product->product_fit_id = (int)$request->input("fit");
            $product->product_neckline_id = (int)$request->input("neckline");
            $product->product_waistline_id = (int)$request->input("waistline");
            $product->product_total = $request->input("product_total");
            $product->product_stock = $request->input("product_stock");
            $product->search_labels = $request->input("search_labels");
            $product->product_detail = $request->input("product_detail");
            $product->product_waistline_id=(int)$request->input("waistline");
            $product->products_description = $request->input("products_description");
            $product->status = (int)$request->input("status");
            $product->updated_at = carbon::now();
            $product->save();
            return redirect()->route("admin_products");
        }
        $data["brand"]=(int)$request->input("brand");
        $data["vendor"]=(int)$request->input("vendor");
        $data["category"]=(int)$request->input("category");
        $data["closure"]=(int)$request->input("closure");
        $data["fabric"]=(int)$request->input("fabric");
        $data["fit"]=(int)$request->input("fit");
        $data["neckline"]=(int)$request->input("neckline");
        $data["waistline"]=(int)$request->input("waistline");
        $data["product_id"]=$product_id;
        $data["product"]=$product;
        
        $data["page_title"]="Edit Product: ".$product->products_name;
        $data["statuses"]=$this->statuses->all();
        $data["categories"]=$this->categories->all();
        $data["closures"]=$this->closures->all();
        $data["brands"]=$this->brands->all();   
        $data["fits"]=$this->fits->all();
        $data["fabrics"]=$this->fabrics->all();
        $data["vendors"]=$this->vendors->all();
        $data["necklines"]=$this->necklines->all();
        $data["waistlines"]=$this->waistlines->all();
        return view("admin/products/edit",$data);
    }
    public function deleteProduct($product_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
           $product = $this->products->find($product_id);
           foreach($product->images as $image){
                $img_path =public_path().'/images/products/'.$image->img_url;
                if(file_exists($img_path)){
                    @unlink($img_path);
                }
            }
            $product->delete();
            return redirect()->route("admin_products");
        }
        $data["product"]=$this->products->find($product_id);
        $data["page_title"]="Delete Product";
        return view("admin/products/confirm",$data);
    }
    public function searchByFilter(Request $request){
        $filter = $request->input("search_input");
        $product = new Products();
        $data=[];
        $data["status"]=(int)$request->input("status");
        $data["page_title"]="Search Product";
        $data["products"]=$product->searchProductsByLabels($filter);
        return view("admin/products/new",$data);
    }
}
