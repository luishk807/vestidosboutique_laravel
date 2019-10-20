<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosMainConfigs as MainConfig;
use App\vestidosAlerts as Alerts;
use Auth;
use Session;
use Artisan;
use Illuminate\Support\Facades\DB;

class adminHomeConfigController extends Controller
{
    //
    public function __construct(MainConfig $main_config, Alerts $alerts){
        $this->main_config=$main_config->first();
        $this->alerts=$alerts;
    }
    function home(){
        $data=[];
        $data["page_title"]=__('header.admin_home_config');
        $data["main_config"] = $this->main_config;
        $data["alerts"]=$this->alerts->where("status","1")->get();
       return view("admin/home_config/edit",$data);
    }
    public function saveHomeConfig(Request $request){
        $data=[];
        $this->validate($request,[
            "allow_credit_card"=>"required",
            "allow_shipping"=>"required"
        ]);
        $this->main_config->allow_credit_card = $request->input("allow_credit_card")=="true" ? true : false;
        $this->main_config->allow_shipping = $request->input("allow_shipping")=="true" ? true : false;
        $this->main_config->allow_billing = $request->input("allow_billing")=="true" ? true : false;
        $this->main_config->allow_delivery_time = $request->input("allow_delivery_time")=="true" ? true : false;
        $this->main_config->alert_id = $request->input("alert_id") ? $request->input("alert_id") : null;
        $this->main_config->alert_id_single = $request->input("alert_id_single") ? $request->input("alert_id_single") : null;
        $this->main_config->save();
        $data["page_title"]=__('header.admin_home_config');
        $data["main_config"] = $this->main_config;
        return redirect()->route('admin_home_config')->withInput($data)->with("msg","Information Saved");
    }
}
