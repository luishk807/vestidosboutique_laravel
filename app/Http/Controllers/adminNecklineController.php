<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosNecklineTypes as Necklines;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;
use Excel;

class adminNecklineController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Necklines $necklines){
        $this->statuses=$vestidosStatus;
        $this->necklines=$necklines;
    }
    public function index(){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('new_neckline'),
                "name"=>"Add Neckline Type"
            ],
            [
                "url"=>route('show_import_neckline'),
                "name"=>"Import Necklines"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_necklines');
        $data["main_items"]=$this->necklines->paginate(10);
        $data["page_title"]="Necklines";
        return view("admin/necklines/home",$data);
    }
    public function newNeckline(Request $request){
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
            $this->necklines->insert($data);
            return redirect()->route("admin_necklines");
        }
        $data["page_title"]="New Neckline";
        return view("admin/necklines/new",$data);
    }
    public function editNeckline($neckline_id,Request $request){
        $data=[];
        $neckline =$this->necklines->find($neckline_id);
        $data["page_title"]="Edit Neckline";
        $data["neckline"]=$neckline;
        $data["neckline_id"]=$neckline_id;
        $data["name"]=$neckline->name;
        $data["status"]=$neckline->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $neckline =$this->necklines->find($neckline_id);
            $neckline->name=$request->input("name");
            $neckline->status=(int)$request->input("status");
            $neckline->updated_at=carbon::now();

            $neckline->save();

            return redirect()->route("admin_necklines");
        }
        $data["page_title"]="Edit Neckline";
        return view("admin/necklines/edit",$data);
    }
    public function deleteNeckline($neckline_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $neckline = $this->necklines->find($neckline_id);
            $neckline->delete();
            return redirect()->route("admin_necklines");
        }
        $data["neckline"]=$this->necklines->find($neckline_id);
        $data["page_title"]="Delete Necklines";
        return view("admin/necklines/confirm",$data);
    }

    public function showImportNeckline(){
        $data=[];
        $data["page_title"]="Import Neckline";
        $data["import_btn"]="Import Neckline";
        return view("/admin/necklines/import",$data);
    }

    public function saveImportNeckline(Request $request){
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
                    Necklines::insert($insert);
                    return redirect()->route('admin_necklines')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmNecklines(Request $request){
        $neckline_ids = $request["neckline_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "neckline_ids"=>"required",
        ],$custom_message);
        $necklines = $this->necklines->getNecklinesByIds($neckline_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_necklines");
        $data["confirm_name"] = "Necklines";
        $data["confirm_data"] = $necklines;
        $data["confirm_delete_url"]=route('delete_necklines');
        $data["page_title"]="Confirm necklines for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteNecklines(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $neckline_ids = $request["item_ids"];
                foreach($neckline_ids as $neckline){
                   $neckline = $this->necklines->find($neckline);
                    $neckline->delete();
                }
               return redirect()->route("admin_necklines")->with('success','Necklines Deleted successfully.');
    }
}
