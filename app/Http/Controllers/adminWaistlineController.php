<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosWaistlineTypes as Waistline;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;

class adminWaistlineController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Waistline $waistlines){
        $this->statuses=$vestidosStatus;
        $this->waistlines=$waistlines;
    }
    public function index(){
        $data=[];
        $data["waistlines"]=$this->waistlines->all();
        $data["page_title"]="Waistlines";
        return view("admin/waistlines/home",$data);
    }
    public function newWaistline(Request $request){
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
            $this->waistlines->insert($data);
            return redirect()->route("admin_waistlines");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Waistline";
        return view("admin/waistlines/new",$data);
    }
    public function editWaistline($waistline_id,Request $request){
        $data=[];
        $waistline =$this->waistlines->find($waistline_id);
        $data["page_title"]="Edit Waistline";
        $data["waistline"]=$waistline;
        $data["waistline_id"]=$waistline_id;
        $data["name"]=$waistline->name;
        $data["status"]=$waistline->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $waistline =$this->waistlines->find($waistline_id);
            $waistline->name=$request->input("name");
            $waistline->status=(int)$request->input("status");
            $waistline->updated_at=carbon::now();

            $waistline->save();

            return redirect()->route("admin_waistlines");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Waistline";
        return view("admin/waistlines/edit",$data);
    }
    public function deleteWaistline($waistline_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $waistline = $this->waistlines->find($waistline_id);
            $waistline->delete();
            return redirect()->route("admin_waistlines");
        }
        $data["waistline"]=$this->waistlines->find($waistline_id);
        $data["page_title"]="Delete Waistlines";
        return view("admin/waistlines/confirm",$data);
    }
    public function showImportWaistline(){
        $data=[];
        $data["page_title"]="Import Waistlines";
        $data["import_btn"]="Import Waistlines";
        return view("admin/waistlines/import",$data);
    }

    public function saveImportWaistline(Request $request){
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
                        "ip"=>$request->ip(),
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Waistline::insert($insert);
                    return redirect()->route('admin_waistlines')->with('success','Insert Record successfully.');
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
