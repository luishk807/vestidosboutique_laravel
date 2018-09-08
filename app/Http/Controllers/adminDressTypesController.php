<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosDressTypes as DressTypes;
use Carbon\Carbon as carbon;
use App\vestidosStatus as vestidosStatus;
use Excel;

class adminDressTypesController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, DressTypes $dressTypes){
        $this->statuses=$vestidosStatus;
        $this->dresstypes=$dressTypes;
    }
    public function index(){
        $data=[];
        $data["dresstypes"]=$this->dresstypes->all();
        $data["page_title"]="Dress Types";
        return view("admin/dress_types/home",$data);
    }
    public function newDressTypes(Request $request){
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
            $this->dresstypes->insert($data);
            return redirect()->route("admin_dresstypes");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Dress Type";
        return view("admin/dress_types/new",$data);
    }
    public function editDressType($dresstype_id,Request $request){
        $data=[];
        $dresstype =$this->dresstypes->find($dresstype_id);
        $data["page_title"]="Edit Dress Type";
        $data["dresstype"]=$dresstype;
        $data["dresstype_id"]=$dresstype_id;
        $data["name"]=$dresstype->name;
        $data["status"]=$dresstype->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $dresstype =$this->dresstypes->find($dresstype_id);
            $dresstype->name=$request->input("name");
            $dresstype->status=(int)$request->input("status");
            $dresstype->updated_at=carbon::now();

            $dresstype->save();

            return redirect()->route("admin_dresstypes");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Dress Type";
        return view("admin/dress_types/edit",$data);
    }
    public function deleteDressType($dresstype_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $dresstype = $this->dresstypes->find($dresstype_id);
            $dresstype->delete();
            return redirect()->route("admin_dresstypes");
        }
        $data["dresstype"]=$this->dresstypes->find($dresstype_id);
        $data["page_title"]="Delete Dress Types";
        return view("admin/dress_types/confirm",$data);
    }
    public function destroy($dresstype_id){
        $data=[];
        $dresstype = $this->dresstypes->find($dresstype_id);
        $dresstype->delete();
        $data["dresstypes"]=$this->dresstypes->all();
        $data["page_title"]="Dress Types";
        return view("admin/dress_types/home",$data);
    }
    public function showImportDressType(){
        $data=[];
        $data["page_title"]="Import Dress Types";
        $data["import_btn"]="Import Dress Types";
        return view("/admin/dress_types/import",$data);
    }

    public function saveImportDressType(Request $request){
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
                    DressTypes::insert($insert);
                    return redirect()->route('admin_dresstypes')->with('success','Insert Record successfully.');
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
