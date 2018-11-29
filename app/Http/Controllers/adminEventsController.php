<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosEvents as Events;
use Carbon\Carbon as carbon;
use Excel;

class adminEventsController extends Controller
{
    //
    public function __construct(Events $events){
        $this->events=$events;
    }
    public function index(){
        $data=[];
        $data["page_title"]="Events";
        $data["page_submenus"]=[
            [
                "url"=>route('new_event'),
                "name"=>"Add Event"
            ],
            [
                "url"=>route('show_import_event'),
                "name"=>"Import Events"
            ]
        ];
        return view("admin/events/home",$data);
    }
    public function newevents(Request $request){
        $data=[];
        if($request->isMethod("post")){
            $data["name"] = $request->input("name");
            $data["status"] = (int)$request->input("status");
            $data["created_at"] = carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required"
            ]);
            $this->events->insert($data);
            return redirect()->route("admin_events");
        }
        $data["page_title"]="New Events";
        return view("admin/events/new",$data);
    }
    public function editevent(Request $request,$event_id){
        $data=[];
        if($request->isMethod("post")){
            $event = $this->events->find($event_id);
            $event->name = $request->input("name");
            $event->updated_at =  carbon::now();
            $this->validate($request,[
                "name"=>"required",
                "status"=>"required"
            ]);
            $event->save();
            return redirect()->route("admin_events");
        }
        $data["name"] = $request->input("name");
        $data["event"]=$this->events->find($event_id);
        $data["event_id"]=$event_id;
        $data["status"] = (int)$request->input("status");

        $data["page_title"]="Edit Events";
        return view("admin/events/edit",$data);
    }
    public function deleteevent($event_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $event = $this->events->find($event_id);
            $event->delete();
            return redirect()->route("admin_events");
        }
        $data["page_title"]="Delete Events";
        $data["event"] = $this->events->find($event_id);
        $data["event_id"]=$event_id;
        return view("admin/events/confirm",$data);
    }

    public function showImportEvent(){
        $data=[];
        $data["page_title"]="Import Events";
        $data["import_btn"]="Import Events";
        return view("admin/events/import",$data);
    }

    public function saveImportEvent(Request $request){
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
                    Events::insert($insert);
                    return redirect()->route('admin_events')->with('success','Insert Record successfully.');
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
