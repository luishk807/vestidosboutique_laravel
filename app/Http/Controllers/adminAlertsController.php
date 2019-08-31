<?php

namespace App\Http\Controllers;
use App\vestidosAlerts as Alerts;
use App\vestidosStatus as vestidosStatus;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

class adminAlertsController extends Controller
{
    //
    public function __construct(vestidosStatus $vestidosStatus, Alerts $alerts){
        $this->statuses=$vestidosStatus;
        $this->alerts=$alerts;
        $this->alert_tabs = [0,1];
    }
    public function index(){
        $data=[];
        $data["main_items"]=$this->alerts->paginate(10);
        $data["page_title"]="Alert Types";
        $data["page_submenus"]=[
            [
                "url"=>route('new_alert'),
                "name"=>"Add Alert"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_alerts');
        return view("admin/alerts/home",$data);
    }
    public function newAlert(){
        $data=[];
        $data["page_title"]="New Alert";
        $data["alert_tabs"] = $this->alert_tabs;
        return view("admin/alerts/new",$data);
    }
    public function createNewAlert(Request $request){
        $data=[];
        $this->validate($request,[
            "title"=>"required",
            "line_1"=>"required",
            "status"=>"required",
        ]
        );
        $action_text = $request->input("action_text");
        $action_link = $request->input("action_link");
        $action_tab = (bool)$request->input("action_tab");
        if(!$this->validateLinkAction($request)){
            return redirect()->back()->withErrors([
                "required","Please complete link and button text field.  Leave empty if no link is needed"
            ]);
        }
        if(empty($action_text) && empty($action_link)){
            $action_text=null;
            $action_link=null;
            $action_tab=null;
        }
        $data["title"]=$request->input("title");
        $data["line_1"]=$request->input("line_1");
        $data["line_2"]=$request->input("line_2");
        $data["action_tab"]= $action_tab;
        $data["action_text"]=$action_text;
        $data["action_link"]=$action_link;
        $data["status"]=(int)$request->input("status");
        $data["created_at"]=carbon::now();
        $date["updated_at"]=carbon::now();
        $this->alerts->insert($data);
        return redirect()->route("admin_alerts")->with("msg","Alert Created");
    }
    public function editAlert($alert_id){
        $data=[];
        $alert =$this->alerts->find($alert_id);
        $data["page_title"]="Edit Alert";
        $data["alert"]=$alert;
        $data["alert_id"]=$alert_id;
        $data["title"]=$alert->title;
        $data["status"]=$alert->status;
        $data["alert_tabs"] = $this->alert_tabs;
        $data["page_title"]="Edit Alert";
        return view("admin/alerts/edit",$data);
    }
    public function validateLinkAction($request){
        $action_text = $request->input("action_text");
        $action_link = $request->input("action_link");
       if(empty($action_text) && empty($action_link)){
            return true;
       }else{
            return !((empty($action_link) && !empty($action_text)) || (!empty($action_link) && empty($action_text)) );
       }
    }
    public function saveAlert($alert_id,Request $request){
        $data=[];
        $alert =$this->alerts->find($alert_id);
        $this->validate($request,[
            "title"=>"required",
            "status"=>"required",
        ]);

        $action_text = $request->input("action_text");
        $action_link = $request->input("action_link");
        $action_tab = (bool)$request->input("action_tab");
        if(!$this->validateLinkAction($request)){
            return redirect()->back()->withErrors([
                "required","Please complete link and button text field.  Leave empty if no link is needed"
            ]);
        }
        if(empty($action_text) && empty($action_link)){
            $action_text=null;
            $action_link=null;
            $action_tab=null;
        }

        $alert =$this->alerts->find($alert_id);
        $alert->title=$request->input("title");
        $alert->line_1=$request->input("line_1");
        $alert->line_2=$request->input("line_2");
        $alert->action_text=$action_text;
        $alert->action_link=$action_link;
        $alert->action_tab = $action_tab;
        $alert->status=(int)$request->input("status");
        $alert->updated_at=carbon::now();
        $alert->save();

       return redirect()->route("admin_alerts")->with("msg","Alert Saved");
    }
    public function deleteAlert($alert_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $alert = $this->alerts->find($alert_id);
            $alert->delete();
            return redirect()->route("admin_alerts")->with("msg","Alert deleted");
        }
        $data["alert"]=$this->alerts->find($alert_id);
        $data["page_title"]="Delete Alerts";
        return view("admin/alerts/confirm",$data);
    }
    public function deleteConfirmAlerts(Request $request){
        $alert_ids = $request["alert_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "alert_ids"=>"required",
        ],$custom_message);
        $alerts = $this->alerts->getAlertsByIds($alert_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_alerts");
        $data["confirm_name"] = "Alerts";
        $data["confirm_data"] = $alerts;
        $data["confirm_delete_url"]=route('delete_alerts');
        $data["page_title"]="Confirm alerts for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteAlerts(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $alert_ids = $request["item_ids"];
                foreach($alert_ids as $alert){
                   $alert = $this->alerts->find($alert);
                    $alert->delete();
                }
               return redirect()->route("admin_alerts")->with('success','Alerts Deleted successfully.');
    }
    public function getAlertInfo(){
        $id = Input::get("data");
        $alert = $this->alerts->find($id);
        return response()->json($alert);
    }
}
