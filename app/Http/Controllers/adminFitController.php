<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosFitTypes as Fits;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;
use Excel;

class adminFitController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Fits $fits){
        $this->statuses=$vestidosStatus;
        $this->fits=$fits;
    }
    public function index(){
        $data=[];
        $data["fits"]=$this->fits->all();
        $data["page_title"]="Fits";
        return view("admin/fits/home",$data);
    }
    public static function getStatusName($fit_status){
        return $this->fits->getStatus($fit_status);
    }
    public function newFits(Request $request){
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
            $this->fits->insert($data);
            return redirect()->route("admin_fits");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="New Fit";
        return view("admin/fits/new",$data);
    }
    public function editFit($fit_id,Request $request){
        $data=[];
        $fit =$this->fits->find($fit_id);
        $data["page_title"]="Edit Fit";
        $data["fit"]=$fit;
        $data["fit_id"]=$fit_id;
        $data["name"]=$fit->name;
        $data["status"]=$fit->status;
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required",
            ]);
            $fit =$this->fits->find($fit_id);
            $fit->name=$request->input("name");
            $fit->status=(int)$request->input("status");
            $fit->updated_at=carbon::now();

            $fit->save();

            return redirect()->route("admin_fits");
        }
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Fit";
        return view("admin/fits/edit",$data);
    }
    public function deleteFit($fit_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $fit = $this->fits->find($fit_id);
            $fit->delete();
            return redirect()->route("admin_fits");
        }
        $data["fit"]=$this->fits->find($fit_id);
        $data["page_title"]="Delete Fits";
        return view("admin/fits/confirm",$data);
    }
    public function showImportFit(){
        $data=[];
        $data["page_title"]="Import Fits";
        $data["import_btn"]="Import Fits";
        return view("/admin/fits/import",$data);
    }

    public function saveImportFit(Request $request){
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
                    Fits::insert($insert);
                    return redirect()->route('admin_fits')->with('success','Insert Record successfully.');
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
