<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon as carbon;
use App\vestidosStyles as DressStyles;
use App\vestidosStatus as vestidosStatus;

class adminDressStylesController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, DressStyles $dressstyles){
        $this->statuses=$vestidosStatus;
        $this->dressstyles=$dressstyles;
    }
    public function index(){
        $data=[];
        $data["dressstyles"]=$this->dressstyles->all();
        $data["page_title"]="Dress Styles";
        return view("admin/dress_styles/home",$data);
    }
    public function newDressStyles(Request $request){
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
            $this->dressstyles->insert($data);
            return redirect()->route("admin_dressstyles");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Dress Style";
        return view("admin/dress_styles/new",$data);
    }
    public function editDressStyle($dressstyle_id,Request $request){
        $data=[];
        $dressstyle =$this->dressstyles->find($dressstyle_id);
        $data["page_title"]="Edit Dress Style";
        $data["dressstyle"]=$dressstyle;
        $data["dressstyle_id"]=$dressstyle_id;
        $data["name"]=$dressstyle->name;
        $data["status"]=$dressstyle->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $dressstyle =$this->dressstyles->find($dressstyle_id);
            $dressstyle->name=$request->input("name");
            $dressstyle->status=(int)$request->input("status");
            $dressstyle->updated_at=carbon::now();

            $dressstyle->save();

            return redirect()->route("admin_dressstyles");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Dress Styles";
        return view("admin/dress_styles/edit",$data);
    }
    public function deleteDressType($dressstyle_id,Request $request){
        $data=[];
        $data["dressstyle"]=$this->dressstyles->find($dressstyle_id);
        $data["page_title"]="Delete Dress Styles";
        return view("admin/dress_styles/confirm",$data);
    }
    public function destroy($dressstyle_id){
        $data=[];
        $dressstyle = $this->dressstyles->find($dressstyle_id);
        $dressstyle->delete();
        $data["dressstyles"]=$this->dressstyles->all();
        $data["page_title"]="Dress Styles";
        return view("admin/dress_styles/home",$data);
    }
}
