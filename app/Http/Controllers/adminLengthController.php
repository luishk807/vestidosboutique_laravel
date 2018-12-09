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
        $data["main_items"]=$this->lengths->paginate(10);
        $data["page_title"]="Length Types";
        $data["page_submenus"]=[
            [
                "url"=>route('new_length'),
                "name"=>"Add Length"
            ],
            [
                "url"=>route('show_import_length'),
                "name"=>"Import Length"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_lengths');
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
    public function deleteConfirmLenghts(Request $request){
        $length_ids = $request["length_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "length_ids"=>"required",
        ],$custom_message);
        $lengths = $this->lengths->getLenghtsByIds($length_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_lengths");
        $data["confirm_name"] = "Lenghts";
        $data["confirm_data"] = $lengths;
        $data["confirm_delete_url"]=route('delete_lengths');
        $data["page_title"]="Confirm lengths for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteLenghts(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $length_ids = $request["item_ids"];
                foreach($length_ids as $length){
                   $length = $this->lengths->find($length);
                    $length->delete();
                }
               return redirect()->route("admin_lengths")->with('success','Lenghts Deleted successfully.');
    }
}
