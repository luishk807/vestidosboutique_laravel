<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosLengthTypes as Lengths;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;
use Excel;

class adminLengthController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Lengths $lengths){
        $this->statuses=$vestidosStatus;
        $this->lengths=$lengths;
    }
    public function index(){
        $data=[];
        $data["lengths"]=$this->lengths->all();
        $data["page_title"]="Length Types";
        return view("admin/lengths/home",$data);
    }
    public function newLengths(Request $request){
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
            $this->lengths->insert($data);
            return redirect()->route("admin_lengths");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Length";
        return view("admin/lengths/new",$data);
    }
    public function editLength($length_id,Request $request){
        $data=[];
        $length =$this->lengths->find($length_id);
        $data["page_title"]="Edit Length";
        $data["length"]=$length;
        $data["length_id"]=$length_id;
        $data["name"]=$length->name;
        $data["status"]=$length->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $length =$this->lengths->find($length_id);
            $length->name=$request->input("name");
            $length->status=(int)$request->input("status");
            $length->updated_at=carbon::now();

            $length->save();

            return redirect()->route("admin_lengths");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Length";
        return view("admin/lengths/edit",$data);
    }
    public function deleteLength($length_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $length = $this->lengths->find($length_id);
            $length->delete();
            return redirect()->route("admin_lengths");
        }
        $data["length"]=$this->lengths->find($length_id);
        $data["page_title"]="Delete Lengths";
        return view("admin/lengths/confirm",$data);
    }
    public function showImportLength(){
        $data=[];
        $data["page_title"]="Import Product";
        $data["import_btn"]="Import Lengths";
        return view("admin/lengths/import",$data);
    }

    public function saveImportLength(Request $request){
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
                    Lengths::insert($insert);
                    return redirect()->route('admin_lengths')->with('success','Insert Record successfully.');
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
