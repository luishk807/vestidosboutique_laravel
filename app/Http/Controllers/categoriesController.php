<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosCategories as Categories;
use Carbon\Carbon as carbon;
use Excel;

class categoriesController extends Controller
{
    //
    public function __construct(Categories $categories){
        $this->categories=$categories;
    }
    public function index(){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('new_category'),
                "name"=>"Add Category"
            ],
            [
                "url"=>route('show_import_category'),
                "name"=>"Import Categories"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_categories');
        $data["page_title"]="Categories";
        return view("admin/categories/home",$data);
    }
    public function newcategories(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $data["name"] = $request->input("name");
            $data["status"] = (int)$request->input("status");
            $data["created_at"] = carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required"
            ]);
            $this->categories->insert($data);
            return redirect()->route("admin_category");
        }
        $data["page_title"]="New Categories";
        return view("admin/categories/new",$data);
    }
    public function editcategory(Request $request,$category_id){
        $data=[];
        if($request->isMethod("post")){
            $category = $this->categories->find($category_id);
            $category->name = $request->input("name");
            $category->updated_at =  carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required"
            ]);
            $category->save();
            return redirect()->route("admin_category");
        }
        $data["name"] = $request->input("name");
        $data["category"]=$this->categories->find($category_id);
        $data["category_id"]=$category_id;
        $data["status"] = (int)$request->input("status");

        $data["page_title"]="Edit Categories";
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
                        "status"=>1,
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Categories::insert($insert);
                    return redirect()->route('admin_category')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmCategories(Request $request){
        $category_ids = $request["category_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "category_ids"=>"required",
        ],$custom_message);
        $categories = $this->categories->getCategoriesByIds($category_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_categories");
        $data["confirm_name"] = "Categories";
        $data["confirm_data"] = $categories;
        $data["confirm_delete_url"]=route('delete_categories');
        $data["page_title"]="Confirm categories for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteCategories(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $category_ids = $request["item_ids"];
                foreach($category_ids as $category){
                   $category = $this->categories->find($category);
                    $category->delete();
                }
               return redirect()->route("admin_categories")->with('success','Categories Deleted successfully.');
    }
}
