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
use App\vestidosProductCategories as ProductCategories;
use App\vestidosProductsRestocks as ProductRestocks;
use Carbon\Carbon as carbon;
use File;

class adminProductController extends Controller
{
    //
    public function __construct(Images $images, vestidosStatus $vestidosStatus, Products $products,Categories $categories, Closures $closures,Colors $colors, Brands $brands, Fits $fits, Fabrics $fabrics, Sizes $sizes,  Vendors $vendors, Necklines $necklines, Waistlines $waistlines, ProductCategories $product_categories,ProductRestocks $product_restocks){
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
        $this->restocks = $product_restocks;
        $this->product_categories = $product_categories;
    }
    function index(){
        $data=[];
        $data["products"]=$this->products->paginate(10);
        $data["page_title"]="Product Page";
        return view("admin/products/home",$data);
    }
    function newProducts(){
        $data=[];


        $data["is_news"]=[0,1];

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
    public function createProduct(Request $request){
        $data=[];
        $this->validate($request,[
            "products_name"=>"required",
            "status"=>"required",
            "brand"=>"required",
            "closure"=>"required",
            "fabric"=>"required",
            "fit"=>"required",
            'purchase_date'=>"required",
            "neckline"=>"required",
            "waistline"=>"required",
            "products_description"=>"required",
            "total_rent"=>"required",
            "product_stock"=>"required"
        ]);
        
        $categories = $request->input("categories");

        $data["products_name"]=$request->input("products_name");
        $data["brand"]=(int)$request->input("brand");
        $data["vendor"]=(int)$request->input("vendor");
        $data["closure"]=(int)$request->input("closure");
        $data["fabric"]=(int)$request->input("fabric");
        $data["fit"]=(int)$request->input("fit");
        $data["neckline"]=(int)$request->input("neckline");
        $data["waistline"]=(int)$request->input("waistline");
        $data["brand_id"]=(int)$request->input("brand");
        $data["vendor_id"]=(int)$request->input("vendor");
        $data["category_id"]=(int)$request->input("category");
        $data["product_closure_id"]=(int)$request->input("closure");
        $data["product_fabric_id"]=(int)$request->input("fabric");
        $data["product_fit_id"]=(int)$request->input("fit");
        $data["product_neckline_id"]=(int)$request->input("neckline");
        $data["product_waistline_id"]=(int)$request->input("waistline");

        $is_for_rent = $request->input("is_for_rent")?true:false;
        $data["is_rent"]=$is_for_rent;
        $data["total_rent"] = $is_for_rent?$request->input("total_rent"):0;

        $is_for_sell = $request->input("is_for_sale")?true:false;
        $data["is_sell"] = $is_for_sell;
        $data["total_sale"] = $is_for_sell?$request->input("total_sale"):0;

        
        $data["product_stock"]=$request->input("product_stock");
        $data["search_labels"]=$request->input("search_labels");
        $data["product_detail"]=$request->input("product_detail");
        $data["product_model"]=$request->input("product_model");
        $data["purchase_date"]=$request->input("purchase_date");
        $data["products_description"]=$request->input("products_description");
        $data["status"]=(int)$request->input("status");
        $data["is_new"]=(int)$request->input("is_new");
        $data["created_at"]=carbon::now();
        $product = Products::create($data);
        if($product->id){
            $catData = [];
            if(count($categories)>0){
                foreach($categories as $category){
                    $this->product_categories->insert([
                        "product_id"=>$product->id,
                        "category_id"=>$category,
                        "created_at"=>carbon::now()
                    ]);
                }
            }
            return redirect()->route("admin_products");   
        }
        return redirect()->back();
    }
    function editProduct($product_id, Request $request){
        $data=[];
        
        $product = $this->products->find($product_id);
        $data["is_news"]=[0,1];
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
    public function saveProduct(Request $request,$product_id){
        $data=[];
        $product = $this->products->find($product_id);
        $data["products_name"]=$request->input("products_name");
        $data["total_rent"]=$request->input("total_rent");
        $data["product_stock"]=$request->input("product_stock");
        $data["search_labels"]=$request->input("search_labels");
        $data["product_detail"]=$request->input("product_detail");
        $data["product_model"]=$request->input("product_model");
        $data["products_description"]=$request->input("products_description");
        $data["purchase_date"]=$request->input("purchase_date");
        $data["status"]=(int)$request->input("status");
        $data["is_new"]=(int)$request->input("is_new");
        
        $categories = $request->input("categories");

        $data["brand"]=(int)$request->input("brand");
        $data["vendor"]=(int)$request->input("vendor");
        $data["category"]=(int)$request->input("category");
        $data["closure"]=(int)$request->input("closure");
        $data["fabric"]=(int)$request->input("fabric");
        $data["fit"]=(int)$request->input("fit");
        $data["neckline"]=(int)$request->input("neckline");
        $data["waistline"]=(int)$request->input("waistline");

        $this->validate($request,[
            "products_name"=>"required",
            "status"=>"required",
            "brand"=>"required",
            "categories"=>"required",
            "vendor"=>"required",
            "closure"=>"required",
            "fabric"=>"required",
            "purchase_date"=>"required",
            "fit"=>"required",
            "neckline"=>"required",
            "waistline"=>"required",
            "products_description"=>"required",
            "total_rent"=>"required",
            "product_stock"=>"required"
        ]);
        $product->products_name = $request->input("products_name");
        $product->brand_id = (int)$request->input("brand");
        $product->vendor_id = (int)$request->input("vendor");
        $product->product_closure_id = (int)$request->input("closure");
        $product->product_fabric_id = (int)$request->input("fabric");
        $product->product_fit_id = (int)$request->input("fit");
        $product->product_neckline_id = (int)$request->input("neckline");
        $product->product_waistline_id = (int)$request->input("waistline");
        
        $is_for_rent = $request->input("is_for_rent")?true:false;
        $product->is_rent=$is_for_rent;
        $product->total_rent = $is_for_rent?$request->input("total_rent"):0;

        $is_for_sell = $request->input("is_for_sale")?true:false;
        $product->is_sell = $is_for_sell;
        $product->total_sale = $is_for_sell?$request->input("total_sale"):0;


        $product->product_stock = $request->input("product_stock");
        $product->search_labels = $request->input("search_labels");
        $product->purchase_date=$request->input("purchase_date");
        $product->product_detail = $request->input("product_detail");
        $product->product_model = $request->input("product_model");
        $product->product_waistline_id=(int)$request->input("waistline");
        $product->products_description = $request->input("products_description");
        $product->status = (int)$request->input("status");
        $product->updated_at = carbon::now();
        $product->is_new=(int)$request->input("is_new");
        if($product->total_rent != $request->input("total_rent")){
            $product->total_rent_old=$request->input("total_rent");
        }
        if($product->total_sale != $request->input("total_sale")){
            $product->total_sale_old=$request->input("total_sale");
        }

        if($product->save()){
            $catData = [];
            //delete all categories for the products
            foreach($product->categories as $p_cat){
                $category_prod = $this->product_categories->find($p_cat->id);
                $category_prod->delete();
            }
            //insert new categories
            if(count($categories)>0){
                foreach($categories as $category){
                    $this->product_categories->insert([
                        "product_id"=>$product->id,
                        "category_id"=>$category,
                        "created_at"=>carbon::now()
                    ]);
                }
            }
            return redirect()->route("admin_products");
        }
        return redirect()->back()->width($data);
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
    public function showRestock($product_id){
        $data=[];
        $product = $this->products->find($product_id);
        $data["restocks"]=$this->restocks->all();
        $data["product"]=$this->products->find($product_id);
        $data["page_title"]="Restock Data for Product ".$product->products_name;
        return view("admin/products/restocks/home",$data);
    }
    public function newRestock($product_id){
        $data=[];
        $data["product"]=$this->products->find($product_id);
        $data["vendors"]=$this->vendors->all();
        $data["page_title"]="Create New Restock";
        return view("admin/products/restocks/new",$data);
    }
    public function createRestock(Request $request, $product_id){
        $data=[];
        $data["product_id"]=$product_id;
        $data["restock_date"]=$request->input("restock_date");
        $data["vendor_id"]=$request->input("vendor");
        $data["quantity"]=$request->input("quantity");
        $data["created_at"]=carbon::now();
        $this->validate($request,[
            "restock_date"=>"required",
            "vendor"=>"required",
            "quantity"=>"required",
        ]);
        if($this->restocks->insert($data)){
            $data["product_id"]=$product_id;
            return redirect()->route("edit_product",$data);
        }
        return redirect()->back()->withErrors([
            "required"=>"Error Saving Restock"
        ]);
    }
    public function editRestock($restock_id){
        $data=[];

        $data["restock"]=$this->restocks->find($restock_id);
        $data["vendors"]=$this->vendors->all();
        $data["page_title"]="Edit Restock";
        return view("admin/products/restocks/edit",$data);
    }
    public function saveRestock(Request $request,$restock_id){
        $data=[];
        $restock = $this->restocks->find($restock_id);
        $data["restock_date"]=$request->input("restock_date");
        $data["vendor"]=$request->input("vendor");
        $data["quantity"]=$request->input("quantity");
        
        $this->validate($request,[
            "restock_date"=>"required",
            "vendor"=>"required",
            "quantity"=>"required",
        ]);
        $restock->restock_date = $request->input("restock_date");
        $restock->quantity = (int)$request->input("quantity");
        $restock->vendor_id = (int)$request->input("vendor");

        if($restock->save()){
            return redirect()->route("restock_product");
        }
        return redirect()->back();
    }
    public function confirmRestock($restock_id){
        $data=[];
        $data["restock"]=$this->restocks->find($restock_id);
        $data["page_title"]="Delete Restock Info";
        return view("admin/products/restocks/confirm",$data);
    }
    public function deleteRestock(Request $request,$restock_id){
        $data=[];
        $restock = $this->restocks->find($restock_id);
        $restock->delete();
        return redirect()->route("admin_restocks",["product_id"=>$restock->product_id]);
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

    public function showTopDress(){
        $data=[];
        $data["products"]=$this->products->where("top_dress","=","1")->get();
        $data["page_title"]="Top Dresses";
        return view("/admin/home_config/top_dresses/home",$data);
    }
    public function newTopDress(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $top_dresses=$request->input("top_dresses");
            $this->validate($request,[
                'top_dresses' => 'required'
             ]
            );
            $this->products->where('top_dress','=',1)->update(array('top_dress'=>null));
            foreach($top_dresses as $product){
                if(!empty($product["product_id"])){
                    $p=$this->products->find($product["product_id"]);
                    $p->top_dress=1;
                    $p->save();
                }
            }
            return redirect()->route("top_dresses_page");
        }
        $data["products"]=$this->products->all();
        $data["page_title"]="New Top Dresses";
        return view("/admin/home_config/top_dresses/new",$data);
    }
    public function showTopQuince(){
        $data=[];
        $data["products"]=$this->products->where("top_quince","=","1")->get();
        $data["page_title"]="Top Quince";
        return view("/admin/home_config/top_quince/home",$data);
    }
    public function newTopQuince(Request $request){
        $data=[];
        $data["products"]=$this->products->all();
        $data["page_title"]="New Top Quince";
        return view("/admin/home_config/top_quince/new",$data);
    }
    public function saveTopQuince(Request $request){

            $top_quince=$request->input("top_quince");
            $this->validate($request,[
                'top_quince' => 'required'
             ]
            );
            $this->products->where('top_quince','=',1)->update(array('top_quince'=>null));
            foreach($top_quince as $product){
                if(!empty($product["product_id"])){
                    $p=$this->products->find($product["product_id"]);
                    $p->top_quince=1;
                    $p->save();
                }
            }
            return redirect()->route("top_quinces_page");
    }
}
