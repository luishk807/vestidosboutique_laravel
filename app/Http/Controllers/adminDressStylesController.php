<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon as carbon;
use App\vestidosStyles as DressStyles;
use App\vestidosStatus as vestidosStatus;
use Excel;

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
        $data["page_submenus"]=[
            [
                "url"=>route('new_dressstyle'),
                "name"=>"Add Dress Style"
            ],
            [
                "url"=>route('show_import_dressstyle'),
                "name"=>"Import Dress Style"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_dressstyles');
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
    public function showImportDressStyle(){
        $data=[];
        $data["page_title"]="Import Dress Styles";
        $data["import_btn"]="Import Dress Styles";
        return view("/admin/dress_styles/import",$data);
    }

    public function saveImportDressStyle(Request $request){
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
                    DressStyles::insert($insert);
                    return redirect()->route('admin_dressstyles')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmDressStyles(Request $request){
        $dressstyle_ids = $request["dressstyle_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "dressstyle_ids"=>"required",
        ],$custom_message);
        $dressstyles = $this->dressstyles->getDressStylesByIds($dressstyle_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_dressstyles");
        $data["confirm_name"] = "DressStyles";
        $data["confirm_data"] = $dressstyles;
        $data["confirm_delete_url"]=route('delete_dressstyles');
        $data["page_title"]="Confirm dressstyles for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteDressStyles(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $dressstyle_ids = $request["item_ids"];
                foreach($dressstyle_ids as $dressstyle){
                   $dressstyle = $this->dressstyles->find($dressstyle);
                    $dressstyle->delete();
                }
               return redirect()->route("admin_dressstyles")->with('success','DressStyles Deleted successfully.');
    }
}
