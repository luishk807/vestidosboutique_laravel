<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as vestidosStatus;
use Excel;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Session;
use File;

class adminPanamaController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus){
        $this->statuses=$vestidosStatus;
    }
    function index(){
        $data=[];
        $data["page_title"]="Panama Import";
        return view("admin/panama/home",$data);
    }
    public function showImportPanama(){
        $data=[];
        $data["page_title"]="Import Panama";
        $data["import_btn"]="Import Panama";
        return view("/admin/panama/import",$data);
    }

    public function saveImportPanama(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            $distrito = null;
            $province = null;
            $dt = null;
            $corregimientos = array();
            if(!empty($data) && $data->count()){
                $insert = array();
                foreach ($data as $value) {
                    if(!empty($value->provincias)){
                        if($province != ucfirst(strtolower($value->provincias))){

                            //if it's not same province, it's a new province
                            $province = ucfirst(strtolower($value->provincias));
                            if(!empty($dt)){
                                $insert[] = $dt;
                                $dt = array();
                            }else{
                               
                                $dt = array(
                                    "province"=>$province,
                                    "distrito"=>null
                                );
                            }
                        }
                        

                        $corregimiento = null;
                        if(!empty($value->corregimientos)){
                            $corregimiento=ucfirst(strtolower($value->corregimientos));
                        }
                        if(!empty($value->distrito)){
                            $distrito=ucfirst(strtolower($value->distrito));
                        }
                        
                        if(!empty($value->distrito)){
                            //if distrct not empty
                            //if the current districto not the same as current district
                            if($distrito != ucfirst(strtolower($value->distrito))){
                                // it's a new district
                                if(count($distritos) > 0){  //if there is a current distrct save and close
                                    $corregimientos[]=$corregimiento;
                                    $distritos->corregimientos = $corregimientos;
                                    $dt->distrito = array("test"=>"this");
                                    $corregimientos=null;
                                    $distritos = null;
                                }else{ //if not, create a brand new
                                    $distritos= array(
                                        "distrito"=>$distrito,
                                        "corregimientos"=>null
                                    );
                                    $corregimientos[]=$corregimiento;
                                }
                            }
                        }else{
                            //if distrct is empty, means still corregimiento
                            $corregimientos[]=$corregimiento;
                        }
                    }
                }
                dd($insert);
                // Session::forget("data_confirm");
                // Session::put("data_confirm",$insert);
                // return redirect()->route('show_confirm_import_product');
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        // return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }

    public function showConfirmImportPanama(){
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
     public function saveConfirmImportPanama(Request $request){
         $data=[];
         $valid_array=false;

         $this->validate($request,[
            "product_confirm.*.products_name"=>"required",
            "product_confirm.*.product_model"=>"required",
            "product_confirm.*.products_description"=>"required",
            "product_confirm.*.brand"=>"required",
            "product_confirm.*.product_stock"=>"required",
            "product_confirm.*.closure"=>"required",
            "product_confirm.*.product_detail"=>"required",
            "product_confirm.*.fabric"=>"required",
            "product_confirm.*.product_length"=>"required",
            "product_confirm.*.neckline"=>"required",
            "product_confirm.*.total_sale"=>"required",
            "product_confirm.*.is_sale"=>"required",
            "product_confirm.*.total_rent"=>"required",
            "product_confirm.*.is_rent"=>"required",
            "product_confirm.*.purchased_date"=>"required",
            "product_confirm.*.vendor"=>"required",
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
                
                 $product_insert = Products::create($insert);
                 $categories = $product["cat"];
                     //insert new categories
                    if(count($categories)>0){
                        foreach($categories as $category){
                            $this->product_categories->insert([
                                "product_id"=>$product_insert->id,
                                "category_id"=>$category,
                                "created_at"=>carbon::now()
                            ]);
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
