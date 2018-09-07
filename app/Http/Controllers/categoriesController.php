<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosCategories as Categories;
use App\vestidosDressTypes as DressTypes;
use App\vestidosStatus as VestidosStatus;
use Carbon\Carbon as carbon;
use App\vestidosStyles as VestidosStyles;

class categoriesController extends Controller
{
    //
    public function __construct(Categories $categories,DressTypes $dressTypes, VestidosStyles $dressstyles, VestidosStatus $statuses){
        $this->categories=$categories;
        $this->dresstypes=$dressTypes;
        $this->statuses = $statuses;
        $this->dressstyles=$dressstyles;
    }
    public function index(){
        $data=[];
        $data["page_title"]="Categories";
        $data["categories"]=$this->categories->all();
        return view("admin/categories/home",$data);
    }
    public function newcategories(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $data["name"] = $request->input("name");
            $data["dress_type_id"] = (int)$request->input("dress_type");
            $data["dress_style_id"] = (int)$request->input("dress_style");
            $data["status"] = (int)$request->input("status");
            $data["created_at"] = carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "dress_type"=>"required",
                "dress_style"=>"required",
                "status"=>"required"
            ]);
            $this->categories->insert($data);
            return redirect()->route("admin_category");
        }
        $data["page_title"]="New Categories";
        $data["categories"]=$this->categories->all();
        $data["dresstypes"]=$this->dresstypes->all();
        $data["statuses"]=$this->statuses->all();
        $data["dressstyles"]=$this->dressstyles->all();
        return view("admin/categories/new",$data);
    }
    public function editcategory(Request $request,$category_id){
        $data=[];
        if($request->isMethod("post")){
            $category = $this->categories->find($category_id);
            $category->name = $request->input("name");
            $category->dress_type_id = $request->input("dress_type");
            $category->dress_style_id = $request->input("dress_style");
            $category->updated_at =  carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "dress_type"=>"required",
                "dress_style"=>"required",
                "status"=>"required"
            ]);
            $category->save();
            return redirect()->route("admin_category");
        }
        $data["name"] = $request->input("name");
        $data["category"]=$this->categories->find($category_id);
        $data["category_id"]=$category_id;
        $data["dress_type_id"] = (int)$request->input("dress_type");
        $data["dress_style_id"] = (int)$request->input("dress_style");
        $data["status"] = (int)$request->input("status");

        $data["page_title"]="Edit Categories";
        $data["categories"]=$this->categories->all();
        $data["dresstypes"]=$this->dresstypes->all();
        $data["statuses"]=$this->statuses->all();
        $data["dressstyles"]=$this->dressstyles->all();
        return view("admin/categories/edit",$data);
    }
    public function deletecategory($category_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $category = $this->categories->find($category_id);
            $category->delete();
            return redirect()->route("admin_category");
        }
        $data["page_title"]="Delete Categories";
        $data["category"] = $this->categories->find($category_id);
        $data["category_id"]=$category_id;
        return view("admin/categories/confirm",$data);
    }

    public function showImportCategory(){
        $data=[];
        $data["page_title"]="Import Categories";
        $data["import_btn"]="Import Categories";
        return view("admin/categories/import",$data);
    }

    public function saveImportCategory(Request $request){
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
                        "dress_type_id"=>$value->dress_type,
                        "dress_style_id"=>$value->dress_style,
                        "status"=>1,
                        "ip"=>$request->ip(),
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Categories::insert($insert);
                    return redirect()->route('admin_categories')->with('success','Insert Record successfully.');
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
