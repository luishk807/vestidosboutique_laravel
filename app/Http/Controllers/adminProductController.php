<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;
use App\vestidosCategories as Categories;
use App\vestidosClosureTypes as Closures;
use App\vestidosColors as Colors;
use App\vestidosBrands as Brands;
use App\vestidosFabricTypes as Fabrics;
use App\vestidosSizes as Sizes;
use App\vestidosProductsImgs as Images;
use App\vestidosVendors as Vendors;
use App\vestidosNecklineTypes as Necklines;
use App\vestidosProductCategories as ProductCategories;
use App\vestidosProductsRestocks as ProductRestocks;
use App\vestidosLengthTypes as Lengths;
use Excel;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Session;
use File;

class adminProductController extends Controller
{
    //
    public function __construct(Images $images, vestidosStatus $vestidosStatus, Products $products,Categories $categories, Closures $closures,Colors $colors, Brands $brands, Fabrics $fabrics, Sizes $sizes,  Vendors $vendors, Necklines $necklines, ProductCategories $product_categories,ProductRestocks $product_restocks, Lengths $lengths){
        $this->statuses=$vestidosStatus;
        $this->products=$products;
        $this->categories=$categories;
        $this->closures=$closures;
        $this->colors=$colors;
        $this->brands=$brands;
        $this->lengths = $lengths;
        $this->fabrics=$fabrics;
        $this->sizes=$sizes;
        $this->vendors=$vendors;
        $this->necklines=$necklines;
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
        $data["lengths"]=$this->lengths->all();
        $data["brands"]=$this->brands->all();
        $data["fabrics"]=$this->fabrics->all();
        $data["vendors"]=$this->vendors->all();
        $data["necklines"]=$this->necklines->all();
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
            'purchase_date'=>"required",
            "neckline"=>"required",
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
        $data["neckline"]=(int)$request->input("neckline");
        $data["brand_id"]=(int)$request->input("brand");
        $data["product_length"]=(int)$request->input("length");
        $data["vendor_id"]=(int)$request->input("vendor");
        $data["category_id"]=(int)$request->input("category");
        $data["product_closure_id"]=(int)$request->input("closure");
        $data["product_fabric_id"]=(int)$request->input("fabric");
        $data["product_neckline_id"]=(int)$request->input("neckline");

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
        $data["lengths"]=$this->lengths->all();
        $data["categories"]=$this->categories->all();
        $data["closures"]=$this->closures->all();
        $data["brands"]=$this->brands->all();
        $data["sizes"]=$product->getAllSizesCount()[0];
        $data["fabrics"]=$this->fabrics->all();
        $data["vendors"]=$this->vendors->all();
        $data["necklines"]=$this->necklines->all();
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
        $data["product_length"]=(int)$request->input("length");
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
        $data["neckline"]=(int)$request->input("neckline");

        $this->validate($request,[
            "products_name"=>"required",
            "status"=>"required",
            "brand"=>"required",
            "categories"=>"required",
            "vendor"=>"required",
            "closure"=>"required",
            "fabric"=>"required",
            "purchase_date"=>"required",
            "neckline"=>"required",
            "products_description"=>"required",
            "total_rent"=>"required",
            "product_stock"=>"required"
        ]);
        $product->products_name = $request->input("products_name");
        $product->brand_id = (int)$request->input("brand");
        $product->vendor_id = (int)$request->input("vendor");
        $product->product_closure_id = (int)$request->input("closure");
        $product->product_fabric_id = (int)$request->input("fabric");
        $product->product_neckline_id = (int)$request->input("neckline");
        
        $is_for_rent = $request->input("is_for_rent")?true:false;
        $product->is_rent=$is_for_rent;
        $product->total_rent = $is_for_rent?$request->input("total_rent"):0;

        $is_for_sell = $request->input("is_for_sale")?true:false;
        $product->is_sell = $is_for_sell;
        $product->total_sale = $is_for_sell?$request->input("total_sale"):0;


        $product->product_stock = $request->input("product_stock");
        $product->search_labels = $request->input("search_labels");
        $product->purchase_date=$request->input("purchase_date");
        $product->product_length = $request->input("length");
        $product->product_detail = $request->input("product_detail");
        $product->product_model = $request->input("product_model");
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

    public function showImportProduct(){
        $data=[];
        $data["page_title"]="Import Product";
        $data["import_btn"]="Import Products";
        return view("/admin/products/import",$data);
    }

    public function saveImportProduct(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);
        $insert=[];
        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            $model_number=null;
            $detail_products=[];
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $sizes = [];
                    $found=false;

                    if(count($insert)>0){
                        foreach($insert as $check){
                            if($check["product_model"]==$value->model_number){
                                $found=true;
                            
                                $color = $detail_products[$model_number];
                                if(!array_key_exists($value->color,$color)){
                                    $detail_products[$model_number][$value->color]=[];
                                }
                                $sizes = $detail_products[$model_number][$value->color];
                                $sizes[]=$value->size;
                                $detail_products[$model_number][$value->color]=$sizes;
                                break;
                            }
                        }
                    }

                    if(!$found){
                        $model_number = $value->model_number;
                        $insert[]=[
                            "products_name"=>$value->product_name,
                            "product_model"=>$value->model_number,
                            "products_description"=>$value->full_description,
                            "brand_id"=>$value->brand,
                            "product_stock"=>$value->stock,
                            "product_closure_id"=>$value->closure,
                            "product_detail"=>$value->short_detail,
                            "product_fabric_id"=>$value->fabric,
                            "product_length"=>$value->product_length,
                            "product_neckline_id"=>$value->neckline,
                            "total_sale"=>$value->total_sale,
                            "is_sell"=>$value->is_for_sale=="yes" ? 1:0,
                            "total_rent"=>$value->total_rent,
                            "is_rent"=>$value->is_for_rent=="yes" ?1:0,
                            "purchase_date"=>$value->purchased_date,
                            "vendor_id"=>$value->vendor,
                            "status"=>1,
                            "ip"=>$request->ip(),
                            "created_at"=>carbon::now(),
                        ];

                        // get the color based on model
                        $detail_products[$model_number][$value->color]=[];
                        $sizes[]=$value->size;
                        $detail_products[$model_number][$value->color]=$sizes;
 

                    }


                }
                // echo "<pre>";
                // print_r($insert);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($detail_products);
                // echo "</pre>";
                Session::forget("data_confirm");
                Session::put("data_confirm",[
                    "insert"=>$insert,
                    "detail"=>$detail_products
                ]);
                return redirect()->route('show_confirm_import_product');
                if(!empty($insert)){
                    Products::insert($insert);
                    return redirect()->route('admin_products')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
       // return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }

    public function showConfirmImportProduct(){
        $data=[];
        if(Session::has("data_confirm")){
             $session = Session::get("data_confirm");
             $data["page_title"]="Confirm Import Data";
             
             $data["is_news"]=[0,1];

             $data["statuses"]=$this->statuses->all();
             $data["categories"]=$this->categories->all();
             $data["closures"]=$this->closures->all();
             $data["brands"]=$this->brands->all();
             $data["fabrics"]=$this->fabrics->all();
             $data["vendors"]=$this->vendors->all();
             $data["necklines"]=$this->necklines->all();

             $data["data_confirm"]=$session;
             return view("admin/products/import_confirm",$data);
        }
        $data["page_title"]="Import Product";
         $data["import_btn"]="Import Product";
        return view("admin/products/import")->with("error","No data to confirm");
     }
     public function saveConfirmImportProduct(Request $request){
         $data=[];
         $valid_array=false;

         $this->validate($request,[
            "product_confirm.*.product_model"=>"required",
            "product_confirm.*.brand"=>"required",
            "product_confirm.*.cat"=>"required",
            "product_confirm.*.product_stock"=>"required",
            "product_confirm.*.purchased_date"=>"required",
         ]);
         $products = $request->input("product_confirm");
         foreach($products as $product){
             if(Arr::exists($product,"key")){
                 $valid_array=true;
                 $insert=[
                    "products_name"=>$product["products_name"],
                    "product_model"=>$product["product_model"],
                    "products_description"=>$product["products_description"],
                    "brand_id"=>$product["brand"],
                    "product_stock"=>$product["product_stock"],
                    "product_closure_id"=>$product["closure"],
                    "product_detail"=>$product["product_detail"],
                    "product_fabric_id"=>$product["fabric"],
                    "product_length"=>$product["product_length"],
                    "product_neckline_id"=>$product["neckline"],
                    "total_sale"=>$product["total_sale"],
                    "is_sell"=>(int)$product["is_sale"],
                    "total_rent"=>$product["total_rent"],
                    "is_rent"=>(int)$product["is_rent"],
                    "purchase_date"=>$product["purchased_date"],
                    "vendor_id"=>$product["vendor"],
                    "status"=>1,
                    "created_at"=>carbon::now(),
                 ];
                //  echo "<pre>";
                // print_r($insert);
                // echo "</pre>";

                // echo "<pre>";
                // print_r($product["color"]);
                // echo "</pre>";

                // echo "<pre>";
                // print_r($product["cat"]);
                // echo "</pre>";
               
                $product_insert = Products::create($insert);
                $product_id = null;
                $product_id = $product_insert->id;
                $categories = $product["cat"];
                //insert new categories
                if(count($categories)>0){
                    foreach($categories as $category){
                        $this->product_categories->insert([
                            "product_id"=>$product_id,
                            "category_id"=>$category,
                            "created_at"=>carbon::now()
                        ]);
                    }
                }
                // insert colors
                $colors = $product["color"];
                if(count($colors)>0){
                    foreach($colors as $color){
                        $color_insert = Colors::create([
                            "product_id"=>$product_id,
                            "name"=>$color["name"],
                            "color_code"=>$color["code"],
                            "created_at"=>carbon::now()
                        ]);
                        $color_id = $color_insert->id;
                       if(!empty($color_id)){
                        $sizes = $color["sizes"];
                            //insert new sizes
                            if(count($sizes)>0){
                                foreach($sizes as $size){
                                    $this->sizes->insert([
                                        "color_id"=>$color_id,
                                        "name"=>$size,
                                        "created_at"=>carbon::now()
                                    ]);
                                }
                            }
                       }
                    }
                }
             }
         }
         if(!$valid_array){
             return redirect()->back()->withErrors(["required"=>"You must select a product"]);
         }else{
             Session::forget("data_confirm");
             return redirect()->route("admin_products")->with("success","import successfully entered");
         }
      }
}
