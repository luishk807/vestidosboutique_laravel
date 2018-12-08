<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosClosureTypes as Closures;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;
use Excel;

class adminClosureController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Closures $closures){
        $this->statuses=$vestidosStatus;
        $this->closures=$closures;
    }
    public function index(){
        $data=[];
        $data["closures"]=$this->closures->all();
        $data["page_title"]="Closure Types";
        $data["page_submenus"]=[
            [
                "url"=>route('new_closure'),
                "name"=>"Add Closure"
            ],
            [
                "url"=>route('show_import_closure'),
                "name"=>"Import Closure"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_closures');
        return view("admin/closures/home",$data);
    }
    public function newClosures(Request $request){
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
            $this->closures->insert($data);
            return redirect()->route("admin_closures");
        }
        $data["page_title"]="New Closure";
        return view("admin/closures/new",$data);
    }
    public function editClosure($closure_id,Request $request){
        $data=[];
        $closure =$this->closures->find($closure_id);
        $data["page_title"]="Edit Closure";
        $data["closure"]=$closure;
        $data["closure_id"]=$closure_id;
        $data["name"]=$closure->name;
        $data["status"]=$closure->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $closure =$this->closures->find($closure_id);
            $closure->name=$request->input("name");
            $closure->status=(int)$request->input("status");
            $closure->updated_at=carbon::now();

            $closure->save();

            return redirect()->route("admin_closures");
        }
        $data["page_title"]="Edit Closure";
        return view("admin/closures/edit",$data);
    }
    public function deleteClosure($closure_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $closure = $this->closures->find($closure_id);
            $closure->delete();
            return redirect()->route("admin_closures");
        }
        $data["closure"]=$this->closures->find($closure_id);
        $data["page_title"]="Delete Closures";
        return view("admin/closures/confirm",$data);
    }
    public function showImportClosure(){
        $data=[];
        $data["page_title"]="Import Product";
        $data["import_btn"]="Import Closures";
        return view("admin/closures/import",$data);
    }

    public function saveImportClosure(Request $request){
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
                    Closures::insert($insert);
                    return redirect()->route('admin_closures')->with('success','Insert Record successfully.');
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
