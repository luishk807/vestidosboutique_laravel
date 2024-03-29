<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosEvents as Events;
use Carbon\Carbon as carbon;
use Excel;
use DB;
use Illuminate\Support\Str;

class adminEventsController extends Controller
{
    //
    public function __construct(Events $events){
        $this->events=$events;
        $this->maxHeight=579;
        $this->maxWidth=1503;
        $this->events_menu = [
            [
                "url"=>route('new_event'),
                "name"=>"Add Event"
            ],
            [
                "url"=>route('show_import_event'),
                "name"=>"Import Events"
            ]
        ];
    }
    public function index(){
        $data=[];
        $data["page_title"]="Events";
        $event_menu = $this->events_menu;
        array_push($event_menu,[
            "url"=>route('show_event_menu'),
            "name"=>"Set Events To Menu"
        ]);
        $data["page_submenus"]= $event_menu;
        $data["main_items"]=$this->events->paginate(10);
        $data["delete_menu"] =route('confirm_delete_events');
        return view("admin/events/home",$data);
    }
    public function showEventMenu(){
        $event_menu = $this->events_menu;
        array_unshift($event_menu,[
            "url"=>route('admin_events'),
            "name"=>"Back To Events"
        ]);
        $data["page_submenus"]= $event_menu;
        $data["page_title"]="Events";
        $data["events"]=$this->events->all();
        return view("admin/events/add_event",$data);
    }
    public function saveEventMenu(Request $request){
        $event_ids = $request["event_ids"];
        $this->validate($request,[
            "event_ids"=>"required|max:".env('MENU_EVENT'),
        ],[
            'event_ids.max'=>"you reached the maximum number if events for the menu"
        ]);
        DB::table('vestidos_events')->update(array('set_menu'=>null));
        if(isset($request["event_ids"]) && count($event_ids) > 0){
            foreach($event_ids as $event){
                $event = $this->events->find($event);
                $event->set_menu=true;
                $event->save();
             }
        }
        return redirect()->route("admin_events")->with('success','Events Updated successfully.');
    }
    public function updateEvents(Request $request){
        $event_ids = $request["event_ids"];
        $custom_message = [
            'required'=>"Please select a item to add to menu"
        ];
        $this->validate($request,[
            "event_ids"=>"required|min:4",
        ],$custom_message);

        foreach($event_ids as $event){
           $event = $this->events->find($event);
           $event->set_menu=true;
           $event->save();
        }
       return redirect()->route("admin_events")->with('success','Events Updated successfully.');
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
            if ($request->hasFile('event_banner')) {
                $file = $request->file('event_banner');
                $maxHeight=$this->maxHeight;
                $maxWidth=$this->maxWidth;
                list($width,$height) = getimagesize($file);
                $picture =$this->getSliderName($file);
                if(($width ==$maxWidth) && ($height == $maxHeight)){
                    $destinationPath = public_path().'/images/shop_banners/';
                    $file->move($destinationPath, $picture);
                    $data["image_url"]=$picture;
                    $data["created_at"]=carbon::now();
                    $this->events->insert($data);
                }
                else{
                    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                }
            }else{
                $this->events->insert($data);
            }
            return redirect()->route("admin_events");
        }
        $data["page_title"]="New Events";
        return view("admin/events/new",$data);
    }
    public function getSliderName($file){
        $picture="";
        $date = carbon::now();
        $time_converted =carbon::createFromFormat('Y-m-d H:i:s', $date)->format('YmdHise'); //get today date time
        $filename = Str::lower($file->getClientOriginalName());
        $filename = pathinfo($filename, PATHINFO_FILENAME); // file
        $extension = $file->getClientOriginalExtension();
        $filename = preg_replace("![^a-z0-9]+!i", "-", $filename);
        $filename = $filename.".".$extension;
        $picture = $time_converted."-".$filename;

        return $picture;
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
            $file = $request->file('event_banner');
            if ($request->hasFile('event_banner')) {
                $maxHeight=$this->maxHeight;
                $maxWidth=$this->maxWidth;
                list($width,$height) = getimagesize($file);
                $picture =$this->getSliderName($file);
                if(($width ==$maxWidth) && ($height == $maxHeight)){
                    if ($request->hasFile('event_banner')) {
                        $img_path =public_path().'/images/shop_banners/'.$event->image_url;
                        if(file_exists($img_path)){
                            @unlink($img_path);
                        }
                        $picture =$this->getSliderName($file);
                        $destinationPath = public_path().'/images/shop_banners/';
                        $file->move($destinationPath, $picture);
                        $event->image_url=$picture;
                    }
                    $event->updated_at=carbon::now();
                    $event->save();
                    return redirect()->route("admin_events");
                }
                else{
                    return redirect()->back()->withErrors(["Incorrect Image Size, Must be ".$this->maxWidth." x ".$this->maxHeight]);
                }
            }else{
                $event->save();
            }
            return redirect()->route("admin_events");
        }else{
        $data["name"] = $request->input("name");
        $data["event"]=$this->events->find($event_id);
        $data["event_id"]=$event_id;
        $data["status"] = (int)$request->input("status");

        $data["page_title"]="Edit Events";
        return view("admin/events/edit",$data);
        }
    }
    public function deleteevent($event_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $event = $this->events->find($event_id);
            $img_path =public_path().'/images/shop_banners/'.$event->image_url;
            if(file_exists($img_path)){
                @unlink($img_path);
            }
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

        if($request->hasFile('event_banner')) {
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
    public function deleteConfirmEvents(Request $request){
        $event_ids = $request["event_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "event_ids"=>"required",
        ],$custom_message);
        $events = $this->events->getEventsByIds($event_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_events");
        $data["confirm_name"] = "Events";
        $data["confirm_data"] = $events;
        $data["confirm_delete_url"]=route('delete_events');
        $data["page_title"]="Confirm events for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteEvents(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $event_ids = $request["item_ids"];
                foreach($event_ids as $event){
                   $event = $this->events->find($event);
                    $img_path =public_path().'/images/shop_banners/'.$event->image_url;
                    if(file_exists($img_path)){
                        @unlink($img_path);
                    }
                    $event->delete();
                }
               return redirect()->route("admin_events")->with('success','Events Deleted successfully.');
    }
}
