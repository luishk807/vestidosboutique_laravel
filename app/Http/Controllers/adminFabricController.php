<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosFabricTypes as Fabrics;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;

class adminFabricController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Fabrics $fabrics){
        $this->statuses=$vestidosStatus;
        $this->fabrics=$fabrics;
    }
    public function index(){
        $data=[];
        $data["fabrics"]=$this->fabrics->all();
        $data["page_title"]="Fabrics";
        return view("admin/fabrics/home",$data);
    }
    public function newFabric(Request $request){
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
            $this->fabrics->insert($data);
            return redirect()->route("admin_fabrics");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Fabric";
        return view("admin/fabrics/new",$data);
    }
    public function editFabric($fabric_id,Request $request){
        $data=[];
        $fabric =$this->fabrics->find($fabric_id);
        $data["page_title"]="Edit Fabric";
        $data["fabric"]=$fabric;
        $data["fabric_id"]=$fabric_id;
        $data["name"]=$fabric->name;
        $data["status"]=$fabric->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $fabric =$this->fabrics->find($fabric_id);
            $fabric->name=$request->input("name");
            $fabric->status=(int)$request->input("status");
            $fabric->updated_at=carbon::now();

            $fabric->save();

            return redirect()->route("admin_fabrics");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Fabric";
        return view("admin/fabrics/edit",$data);
    }
    public function deleteFabric($fabric_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $fabric = $this->fabrics->find($fabric_id);
            $fabric->delete();
            return redirect()->route("admin_fabrics");
        }
        $data["fabric"]=$this->fabrics->find($fabric_id);
        $data["page_title"]="Delete Fabric";
        return view("admin/fabrics/confirm",$data);
    }
}
