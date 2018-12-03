<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosPaymentTypes as PaymentTypes;
use App\vestidosCountries as Countries;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Excel;
use Session;
use Validator;

class adminPaymentTypesController extends Controller
{
    //
    public function __construct(Statuses $statuses, PaymentTypes $payment_types, Countries $countries){
        $this->statuses=$statuses;
        $this->payment_types=$payment_types;
        $this->countries=$countries;
    }
    function index(){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('new_payment'),
                "name"=>"Add Payment Types"
            ]
        ];
        $data["payment_types"]=$this->payment_types->all();
        $data["page_title"]="Payment Page";
        return view("admin/payment_types/home",$data);
    }
    function newPayments(){
        $data=[];
        $data["page_title"]="Create Payments Page";
        return view("admin/payment_types/new",$data);
    }
    function createPayments(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["description"]=$request->input("description");
        $data["status"]=$request->input("status");
        $this->validate($request,[
            "name"=>"required",
            "description"=>"required",
            "status"=>"required",
        ]);
        $data["created_at"]=carbon::now();
        $this->payment_types->insert($data);
        return redirect()->route("admin_payments");
    }
    function editPayment($payment_type_id){
        $data=[];
        $payment_type = $this->payment_types->find($payment_type_id);
        $data["payment_type"]=$payment_type;
        $data["page_title"]="Edit Payments";
        $data["payment_type_id"]=$payment_type_id;
        return view("admin/payment_types/edit",$data);
    }
    function savePayment($payment_type_id, Request $request){
        $data=[];
        $payment_type = $this->payment_types->find($payment_type_id);
        $this->validate($request,[
            "name"=>"required",
            "description"=>"required",
            "status"=>"required",
        ]);
        
        $payment_type->name = $request->input("name");
        $payment_type->description = $request->input("description");
        $payment_type->status = $request->input("status");
        $payment_type->save();
        return redirect()->route("admin_payments");
    }
    public function showDeletePayment($payment_type_id){
        $data=[];
        $data["payment_type"]=$this->payment_types->find($payment_type_id);
        $data["page_title"]="Delete Payment";
        return view("admin/payment_types/confirm",$data);
    }
    public function deletePayment($payment_type_id,Request $request){
        $data=[];
        $payment_type = $this->payment_types->find($payment_type_id);
        $payment_type->delete();
        return redirect()->route("admin_payments");
    }
}
