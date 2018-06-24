<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosNecklineTypes as Necklines;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;

class adminNecklineController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Necklines $necklines){
        $this->statuses=$vestidosStatus;
        $this->necklines=$necklines;
    }
    public function index(){
        $data=[];
        $data["necklines"]=$this->necklines->all();
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
        $data["statuses"]=$this->statuses->all();
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
        $data["statuses"]=$this->statuses->all();
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
}
