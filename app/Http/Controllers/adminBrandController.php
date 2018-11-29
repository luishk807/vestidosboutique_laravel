<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosBrands as vestidosBrands;
use App\vestidosStatus as vestidosStatus;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\DB;
use Excel;

class adminBrandController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, vestidosBrands $vestidosBrands){
        $this->statuses=$vestidosStatus;
        $this->brand=$vestidosBrands;
    }
    public function index(){
        $data=[];
        $data["page_title"]="Brands";
        $data["page_submenus"]=[
            [
                "url"=>route('new_brand'),
                "name"=>"Add Brand"
            ],
            [
                "url"=>route('show_import_brands'),
                "name"=>"Import Brands"
            ]
        ];
        return view("admin/brands/home",$data);
    }
    public function newBrands(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
        
                "name"=>"required",
                "status"=>"required",
            ]
            );
            $data["created_at"]=carbon::now();
            $date["updated_at"]=carbon::now();
            $this->brand->insert($data);
            return redirect()->route("admin_brands");
        }
        $data["page_title"]="New Brand";
        return view("admin/brands/new",$data);
    }
    public function editBrand($brand_id,Request $request){
        $data=[];
        $brand =$this->brand->find($brand_id);
        $data["page_title"]="Edit Brand";
        $data["brand"]=$brand;
        $data["brand_id"]=$brand_id;
        $data["name"]=$brand->name;
        $data["status"]=$brand->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $brand =$this->brand->find($brand_id);
            $brand->name=$request->input("name");
            $brand->status=(int)$request->input("status");
            $brand->updated_at=carbon::now();

            $brand->save();

            return redirect()->route("admin_brands");
        }
        $data["page_title"]="Edit Brand";
        return view("admin/brands/edit",$data);
    }
    public function deleteBrand($brand_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $brand = $this->brand->find($brand_id);
            $brand->delete();
            return redirect()->route("admin_brands");
        }
        $data["brand"]=$this->brand->find($brand_id);
        $data["page_title"]="Delete Brands";
        return view("admin/brands/confirm",$data);
    }
    public function showImportBrand(){
        $data=[];
        $data["page_title"]="Import Brands";
        $data["import_btn"]="Import Brands";
        return view("admin/brands/import",$data);
    }

    public function saveImportBrand(Request $request){
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
                //dd($insert);
                if(!empty($insert)){
                    vestidosBrands::insert($insert);
                    return redirect()->route('admin_brands')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
       return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
}
