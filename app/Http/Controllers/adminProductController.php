<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;
use App\vestidosClosureTypes as Closures;
use App\vestidosColors as Colors;
use App\vestidosFabricTypes as Fabrics;
use App\vestidosSizes as Sizes;
use App\vestidosProductsImgs as Images;
use App\vestidosVendors as Vendors;
use App\vestidosNecklineTypes as Necklines;
use App\vestidosProductTypes as ProductTypes;
use App\vestidosProductsRestocks as ProductRestocks;
use App\vestidosLengthTypes as Lengths;
use App\vestidosProductEvents as ProductEvents;
use Excel;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Session;
use File;

class adminProductController extends Controller
{
    //
    public function __construct(Images $images, Products $products,Closures $closures,  Vendors $vendors,Colors $colors, Fabrics $fabrics, Sizes $sizes, Necklines $necklines, Lengths $lengths, ProductTypes $product_types,ProductRestocks $product_restocks,ProductEvents $product_events){
        $this->products=$products;
        $this->closures=$closures;
        $this->colors=$colors;
        $this->lengths = $lengths;
        $this->product_types = $product_types;
        $this->fabrics=$fabrics;
        $this->sizes=$sizes;
        $this->restocks = $product_restocks;
        $this->colors=$colors;
        $this->vendors=$vendors;
        $this->necklines=$necklines;
        $this->images = $images;

        $this->product_events = $product_events;

    }
    function index(){
        $data=[];
        $data["products"]=$this->products->paginate(10);

        $data["page_submenus"]=[
            [
                "url"=>route('new_product'),
                "name"=>"Add Product Manually"
            ],
            [
                "url"=>route('show_import_product'),
                "name"=>"Add Product From File"
            ],
            [
                "url"=>route('admin_restocks'),
                "name"=>"Restock"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_products');
        $data["page_title"]="Product Page";
        return view("admin/products/home",$data);
    }
    function newProducts(){
        $data=[];
        $data["is_news"]=[0,1];
        $data["page_title"]="Create Products Page";
        $data["closures"]=$this->closures->all();
        $data["lengths"]=$this->lengths->all();
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
            "style"=>"required",
            'purchase_date'=>"required",
            "neckline"=>"required",
            "products_description"=>"required",
        ]);
        
        $events = $request->input("events");

        $data["products_name"]=$request->input("products_name");
        $data["brand"]=(int)$request->input("brand");
        $data["vendor"]=(int)$request->input("vendor");
        $data["closure"]=(int)$request->input("closure");
        $data["fabric"]=(int)$request->input("fabric");
        $data["neckline"]=(int)$request->input("neckline");
        $data["brand_id"]=(int)$request->input("brand");
        $data["product_length"]=(int)$request->input("length");
        $data["vendor_id"]=(int)$request->input("vendor");
        $data["style"]=(int)$request->input("style");
        $data["category_id"]=(int)$request->input("category");
        $data["product_closure_id"]=(int)$request->input("closure");
        $data["product_fabric_id"]=(int)$request->input("fabric");
        $data["product_neckline_id"]=(int)$request->input("neckline");

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
            if(count($events)>0){
                foreach($events as $event){
                    $this->product_events->insert([
                        "product_id"=>$product->id,
                        "event_id"=>$event,
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
        $sizes = $product->getAllSizesCount()[0];
 
        $data["page_submenus"]=[
            [
            "url"=> route('admin_products'),
            "name"=>"Back to Products"
            ],
            [
                "url"=>route('admin_images',['product_id'=>$product_id]),
                "name"=>"[".$product->images()->count()."] View Images"
            ],
            [
                "url"=>route('admin_colors',['product_id'=>$product_id]),
                "name"=>"[".$product->colors()->count()."] View Colors"
            ],
            [
                "url"=>route('admin_sizes',['product_id'=>$product_id]),
                "name"=>"[".$sizes->count."] View Sizes"
            ],
            [
                "url"=>route('admin_rates',['product_id'=>$product_id]),
                "name"=>"[".$product->rates()->count()."]  View Rates"
            ]
        ];
        $data["is_news"]=[0,1];
        $data["product_id"]=$product_id;
        $data["product"]=$product;
        $data["page_title"]="Edit Product: ".$product->products_name;
        $data["lengths"]=$this->lengths->all();
        $data["closures"]=$this->closures->all();
        $data["sizes"]=$sizes;
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
        $data["search_labels"]=$request->input("search_labels");
        $data["product_detail"]=$request->input("product_detail");
        $data["product_model"]=$request->input("product_model");
        $data["product_length"]=(int)$request->input("length");
        $data["products_description"]=$request->input("products_description");
        $data["purchase_date"]=$request->input("purchase_date");
        $data["status"]=(int)$request->input("status");
        $data["is_new"]=(int)$request->input("is_new");
        
        $events = $request->input("events");

        $data["brand"]=(int)$request->input("brand");
        $data["vendor"]=(int)$request->input("vendor");
        $data["category"]=(int)$request->input("category");
        $data["closure"]=(int)$request->input("closure");
        $data["fabric"]=(int)$request->input("fabric");
        $data["neckline"]=(int)$request->input("neckline");
        $data["style"]=(int)$request->input("style");

        $this->validate($request,[
            "products_name"=>"required",
            "status"=>"required",
            "brand"=>"required",
            "style"=>"required",
            "events"=>"required",
            "vendor"=>"required",
            "closure"=>"required",
            "fabric"=>"required",
            "purchase_date"=>"required",
            "neckline"=>"required",
            "products_description"=>"required",
        ]);
        $product->products_name = $request->input("products_name");
        $product->brand_id = (int)$request->input("brand");
        $product->vendor_id = (int)$request->input("vendor");
        $product->style = (int)$request->input("style");
        $product->product_closure_id = (int)$request->input("closure");
        $product->product_fabric_id = (int)$request->input("fabric");
        $product->product_neckline_id = (int)$request->input("neckline");

        $product->search_labels = $request->input("search_labels");
        $product->purchase_date=$request->input("purchase_date");
        $product->product_length = $request->input("length");
        $product->product_detail = $request->input("product_detail");
        $product->product_model = $request->input("product_model");
        $product->products_description = $request->input("products_description");
        $product->status = (int)$request->input("status");
        $product->updated_at = carbon::now();
        $product->is_new=(int)$request->input("is_new");

        if($product->save()){
            $eventData = [];
            //delete all categories for the products
            foreach($product->events as $p_event){
                $event_prod = $this->product_events->find($p_event->id);
                $event_prod->delete();
            }
            //insert new categories
            if(count($events)>0){
                foreach($events as $event){
                    $this->product_events->insert([
                        "product_id"=>$product->id,
                        "event_id"=>$event,
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
        $data["page_submenus"]=[
            [
                "url"=>route('new_top_dress'),
                "name"=>"Select Top Dresses"
            ]
        ];
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
        $data["page_submenus"]=[
            [
                "url"=>route('new_top_quince'),
                "name"=>"Select Top Quince"
            ]
        ];
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
                                $sizes[]=[
                                    "size"=>$value->size,
                                    "stock"=>$value->stock,
                                    "total_sale"=>$value->total_sale,
                                    "is_sell"=>$value->is_for_sale=="yes" ? 1:0,
                                    "total_rent"=>$value->total_rent,
                                    "is_rent"=>$value->is_for_rent=="yes" ?1:0,
                                ];
                                $detail_products[$model_number][$value->color]=$sizes;
                                break;
                            }
                        }
                    }

                    if(!$found){
                        $model_number = $value->model_number;
                        $insert[]=[
                            "products_name"=>$value->product_name,
                            "category_id"=>$value->category,
                            "product_type_id"=>$value->product_type,
                            "product_model"=>$value->model_number,
                            "products_description"=>$value->full_description,
                            "brand_id"=>$value->brand,
                            "product_closure_id"=>$value->closure,
                            "product_detail"=>$value->short_detail,
                            "product_fabric_id"=>$value->fabric,
                            "product_length"=>$value->product_length,
                            "product_neckline_id"=>$value->neckline,
                            "product_style_id"=>$value->style,
                            "purchase_date"=>$value->purchased_date,
                            "vendor_id"=>$value->vendor,
                            "status"=>1,
                            "ip"=>$request->ip(),
                            "created_at"=>carbon::now(),
                        ];

                        // get the color based on model
                        $detail_products[$model_number][$value->color]=[];
                        $sizes[]=[
                            "size"=>$value->size,
                            "stock"=>$value->stock,
                            "total_sale"=>$value->total_sale,
                            "is_sell"=>$value->is_for_sale=="yes" ? 1:0,
                            "total_rent"=>$value->total_rent,
                            "is_rent"=>$value->is_for_rent=="yes" ?1:0,
                        ];
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
      return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function showRestock(){
        $data=[];
        $data["restocks"]=$this->restocks->all();
        
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
                "url"=>route('new_restock'),
                "name"=>"Add Restock Data"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_restocks');
        $data["page_title"]="Restock Data";
        return view("admin/products/restocks/home",$data);
    }
    public function newRestock(){
        $data=[];
        $data["vendors"]=$this->vendors->all();
        $data["products"]=$this->products->all();
        $data["page_title"]="Create New Restock";
        return view("admin/products/restocks/new",$data);
    }
    public function createRestock(Request $request){
        $data=[];
        $data["restock_date"]=$request->input("restock_date");
        $data["product_id"]=$request->input("product");
        $data["vendor_id"]=$request->input("vendor");
        $data["color"]=$request->input("color");
        $data["size"]=$request->input("size");
        $data["quantity"]=$request->input("quantity");
        $data["created_at"]=carbon::now();
        $this->validate($request,[
            "restock_date"=>"required",
            "product"=>"required",
            "vendor"=>"required",
            "size"=>"required",
            "color"=>"required",
            "quantity"=>"required",
        ]);
        if($this->restocks->insert($data)){
            $size = $this->sizes->find($request->input("size"));
            $size->stock  = $size->stock + $request->input("quantity");
            $size->save();
            return redirect()->route("admin_products",$data)->with('success','Insert Record successfully.');;
        }
        $data["product"]=$request->input("product");
        $data["vendor"]=$request->input("vendor");
        return redirect()->back()->withErrors([
            "required"=>"Error Saving Restock"
        ]);
    }
    public function editRestock($restock_id){
        $data=[];
        $restock = $this->restocks->find($restock_id);
        $data["restock"]=$restock;
        $data["vendors"]=$this->vendors->all();
        $data["sizes"]=$this->sizes->where("color_id",$restock->color)->get();
        $data["page_title"]="Edit Restock";
        return view("admin/products/restocks/edit",$data);
    }
    public function saveRestock(Request $request,$restock_id){
        $data=[];
        $restock = $this->restocks->find($restock_id);
        $color = $this->colors->find($restock->color);
        $data["restock_date"]=$request->input("restock_date");
        $data["vendor"]=$request->input("vendor");
        $data["color"]=$request->input("color");
        $data["size"]=$request->input("size");
        $data["quantity"]=$request->input("quantity");
        
        $this->validate($request,[
            "restock_date"=>"required",
            "vendor"=>"required",
            "size"=>"required",
            "color"=>"required",
            "quantity"=>"required",
        ]);
        $restock->restock_date = $request->input("restock_date");
        $restock->quantity = $request->input("quantity");
        $restock->color =$request->input("color");
        $restock->size =$request->input("size");
        $restock->vendor_id =$request->input("vendor");

        if($restock->save()){
            return redirect()->route("admin_restocks",$data)->with('success','Restock saved successfully.');;
        }
        return redirect()->back()->with('error','Unable to save restock.');;
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
        return redirect()->route("admin_restocks",["product_id"=>$restock->product_id])->with('success','Restock deleted successfully.');;
    }
    public function showConfirmImportProduct(){
        $data=[];
        if(Session::has("data_confirm")){
             $session = Session::get("data_confirm");
             $data["page_title"]="Confirm Import Data";
             $data["is_news"]=[0,1];
             $data["fabrics"]=$this->fabrics->all();
             $data["vendors"]=$this->vendors->all();
             $data["closures"]=$this->closures->all();
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
        //  $this->validate($request,[
        //     "product_confirm.*.product_model"=>"required",
        //     "product_confirm.*.brand"=>"required",
        //     "product_confirm.*.event"=>"required",
        //     "product_confirm.*.purchased_date"=>"required",
        //  ]);
         $products = $request->input("product_confirm");
         foreach($products as $product){
             if(Arr::exists($product,"key")){
                 $valid_array=true;
                 $insert=[
                    "products_name"=>$product["products_name"],
                    "category_id"=>$product["category"],
                    "product_type_id"=>$product["product_type"],
                    "product_model"=>$product["product_model"],
                    "products_description"=>$product["products_description"],
                    "brand_id"=>$product["brand"],
                    "style"=>$product["style"],
                    "product_closure_id"=>$product["closure"],
                    "product_detail"=>$product["product_detail"],
                    "product_fabric_id"=>$product["fabric"],
                    "product_length"=>$product["product_length"],
                    "product_neckline_id"=>$product["neckline"],
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
                 $events = $product["event"];
                // //insert new events
                if(count($events)>0){
                    foreach($events as $event){
                        //echo $event."<br/>";
                        $this->product_events->insert([
                            "product_id"=>$product_id,
                            "event_id"=>$event,
                            "created_at"=>carbon::now()
                        ]);
                    }
                }
                //insert colors
                $colors = $product["color"];
                if(count($colors)>0){
                    foreach($colors as $color){
                        //echo $color["name"]."<br/>";
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
                                    // echo "<pre>";
                                    // print_r($size);
                                    // echo "</pre>";
                                    $this->sizes->insert([
                                        "color_id"=>$color_id,
                                        "name"=>$size["size"],
                                        "total_sale"=>$size["total_sale"],
                                        "is_sell"=>$size["is_sell"],
                                        "total_rent"=>$size["total_rent"],
                                        "is_rent"=>$size["is_rent"],
                                        "stock"=>$size["stock"],
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
      public function deleteConfirmProducts(Request $request){
        $product_ids = $request["product_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "product_ids"=>"required",
        ],$custom_message);
        $products = $this->products->getProductsByIds($product_ids);
        $data["confirm_type"] = "img";
        $data["confirm_return"] = route("admin_products");
        $data["confirm_name"] = "Products";
        $data["confirm_data"] = $products;
        $data["confirm_delete_url"]=route('delete_products');
        $data["page_title"]="Confirm products for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteProducts(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $product_ids = $request["item_ids"];
                foreach($product_ids as $product){
                   $product = $this->products->find($product);
                   foreach($product->images as $image){
                        $img_path =public_path().'/images/products/'.$image->img_url;
                        if(file_exists($img_path)){
                            @unlink($img_path);
                        }
                    }
                    $product->delete();
                }
               return redirect()->route("admin_products")->with('success','Products Deleted successfully.');
    }
    public function deleteConfirmRestocks(Request $request){
        $restock_ids = $request["restock_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "restock_ids"=>"required",
        ],$custom_message);
        $restocks = $this->restocks->getRestocksByIds($restock_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_restocks");
        $data["confirm_name"] = "Restocks";
        $data["confirm_data"] = $restocks;
        $data["confirm_delete_url"]=route('delete_restocks');
        $data["page_title"]="Confirm restocks for deletion";
         return view("admin/confirm_delete",$data);
    }
    public function deleteRestocks(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $restock_ids = $request["item_ids"];
                foreach($restock_ids as $restock){
                   $restock = $this->restocks->find($restock);
                    $restock->delete();
                }
               return redirect()->route("admin_restocks")->with('success','Restocks Deleted successfully.');
    }
}
