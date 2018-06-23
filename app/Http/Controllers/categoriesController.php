<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosCategories as Categories;
use App\vestidosDressTypes as DressTypes;
use App\vestidosStatus as VestidosStatus;
use App\vestidosStyles as VestidosStyles;

class categoriesController extends Controller
{
    //
    public function __construct(Categories $categories,DressTypes $dressTypes, VestidosStyles $vestidosStyles, VestidosStatus $statuses){
        $this->categories=$categories;
        $this->dresstypes=$dressTypes;
        $this->statuses = $statuses;
        $this->vestidosstyles=$vestidosStyles;
    }
    public function index(){
        $data=[];
        $data["page_title"]="Categories";
        $data["categories"]=$this->categories->all();
        return view("admin/categories/home",$data);
    }
    public function newcategories(Request $request){
        $data=[];
        $data["page_title"]="New Categories";
        $data["categories"]=$this->categories->all();
        $data["dresstypes"]=$this->dresstypes->all();
        $data["statuses"]=$this->statuses->all();
        $data["vestidosstyles"]=$this->vestidosstyles->all();
        return view("admin/categories/new",$data);
    }
    public function editcategory(Request $request,$category_id){
        $data=[];
        $data["page_title"]="Edit Categories";
        $data["categories"]=$this->categories->all();
        return view("admin/categories/new",$data);
    }
    public function deletecategory($category_id){
        $data=[];
        $data["page_title"]="Delete Categories";
        $data["category"] = $this->categories->find($category_id);
        return view("admin/categories/confirm",$data);
    }
    public function destroy($category_id){
        $data=[];
        $data["page_title"]="Delete Categories";
        $data["categories"]=$this->categories->all();

        $category = $this->categories->find($category_id);
        $category->delete();
        return view("admin/categories/home",$data);
    }
}
