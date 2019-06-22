<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosVendors as Vendors;
use App\vestidosCountries as Countries;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Excel;
use Session;
use Validator;

class vendorsController extends Controller
{
    //
    public function __construct(Statuses $statuses, Vendors $vendors, Countries $countries){
        $this->statuses=$statuses;
        $this->vendors=$vendors;
        $this->countries=$countries;
    }
    function index(){
        $data=[];
        $data["main_items"]=$this->vendors->paginate(10);
        $data["page_submenus"]=[
            [
                "url"=>route('new_vendor'),
                "name"=>"Add Vendor"
            ],
            [
                "url"=>route('show_import_vendor'),
                "name"=>"Import Vendor"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_vendors');
        $data["page_title"]="Vendor Page";
        return view("admin/vendors/home",$data);
    }
    function newVendors(Request $request){
        $data=[];
        $data["company_name"]=$request->input("company_name");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number_1"]=$request->input("phone_number_1");
        $data["email"]=$request->input("email");
        $data["address_1"]=$request->input("address_1");
        $data["address_2"]=$request->input("address_2");
        $data["city"]=$request->input("city");
        $data["country_id"]=(int)$request->input("country");
        $data["state"]=$request->input("state");
        $data["zip_code"]=$request->input("zip_code");
        $data["status"]=(int)$request->input("status");
        $data["ip_address"]=$request->ip();
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required|email|unique:vestidos_vendors,email",
                "address_1"=>"required",
                "country"=>"required",
                "city"=>"required",
                "state"=>"required",
                "zip_code"=>"required",
                "status"=>"required",
            ]);
            $data["created_at"]=carbon::now();
            $this->vendors->insert($data);
            return redirect()->route("admin_vendors");
        }
        $data["country"]=$request->input("country");

        $data["page_title"]="Create Vendors Page";
        return view("admin/vendors/new",$data);
    }
    function editVendor($vendor_id, Request $request){
        $data=[];
        $data["company_name"]=$request->input("company_name");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number_1"]=$request->input("phone_number_1");
        $data["email"]=$request->input("email");
        $data["address_1"]=$request->input("address_1");
        $data["address_2"]=$request->input("address_2");
        $data["city"]=$request->input("city");
        $data["state"]=$request->input("state");
        $data["zip_code"]=$request->input("zip_code");
        $data["status"]=(int)$request->input("status");
        $vendor = $this->vendors->find($vendor_id);
        if($request->isMethod("post")){
            $this->validate($request,[
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required|email|unique:vestidos_vendors,email,".$vendor->id,
                "address_1"=>"required",
                "country"=>"required",
                "city"=>"required",
                "state"=>"required",
                "zip_code"=>"required",
                "status"=>"required",
            ]);
            $vendor->company_name = $request->input("company_name");
            $vendor->first_name = $request->input("first_name");
            $vendor->middle_name = $request->input("middle_name");
            $vendor->last_name = $request->input("last_name");
            $vendor->phone_number_1 = $request->input("phone_number_1");
            $vendor->email = $request->input("email");
            $vendor->address_1 = $request->input("address_1");
            $vendor->address_2 = $request->input("address_2");
            $vendor->city = $request->input("city");
            $vendor->country_id = (int)$request->input("country");
            $vendor->state = $request->input("state");
            $vendor->zip_code = $request->input("zip_code");
            $vendor->status = (int)$request->input("status");
            $vendor->updated_at = carbon::now();
            $vendor->save();
            return redirect()->route("admin_vendors");
        }
        $data["country"]=$request->input("country");
        $data["vendor"]=$vendor;
        $data["page_title"]="Edit Vendors";
        $data["vendor_id"]=$vendor_id;
       return view("admin/vendors/edit",$data);
    }
    public function deleteVendor($vendor_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $vendor = $this->vendors->find($vendor_id);
            $vendor->delete();
            return redirect()->route("admin_vendors");
        }
        $data["vendor"]=$this->vendors->find($vendor_id);
        $data["page_title"]="Delete Vendor";
        return view("admin/vendors/confirm",$data);
    }
    public function deleteConfirmVendors(Request $request){
        $vendor_ids = $request["vendor_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "vendor_ids"=>"required",
        ],$custom_message);
        $vendors = $this->vendors->getVendorsByIds($vendor_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_vendors");
        $data["confirm_name"] = "Vendors";
        $data["confirm_data"] = $vendors;
        $data["confirm_delete_url"]=route('delete_vendors');
        $data["page_title"]="Confirm vendors for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteVendors(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $vendor_ids = $request["item_ids"];
                foreach($vendor_ids as $vendor){
                   $vendor = $this->vendors->find($vendor);
                    $vendor->delete();
                }
               return redirect()->route("admin_vendors")->with('success','Vendors Deleted successfully.');
    }
    public function showImportVendor(){
        $data=[];
        $data["page_title"]="Import Vendors";
        $data["import_btn"]="Import Vendors";
        return view("admin/vendors/import",$data);
    }

    public function saveImportVendor(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            $bad_data=[];
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $insert[]=[
                        "company_name"=>$value->company_name,
                        "first_name"=>$value->first_name,
                        "middle_name"=>$value->middle_name,
                        "last_name"=>$value->last_name,
                        "phone_number_1"=>$value->phone_1,
                        "phone_number_2"=>$value->phone_2,
                        "email"=>$value->email,
                        "address_1"=>$value->address_1,
                        "address_2"=>$value->address_2,
                        "city"=>$value->city,
                        "state"=>$value->state,
                        "country_id"=>$value->country,
                        "zip_code"=>$value->zip_code,
                        "status"=>1,
                        "ip_address"=>$request->ip(),
                        "created_at"=>carbon::now(),
                    ];
                }
                Session::forget("data_confirm");
                Session::put("data_confirm",$insert);
                return redirect()->route('show_import_vendor_confirm');
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function showImportVendor_confirm(){
       $data=[];
       if(Session::has("data_confirm")){
            $session = Session::get("data_confirm");
            $data["page_title"]="Confirm Import Data";
            $data["data_confirm"]=$session;
            return view("admin/vendors/import_confirm",$data);
       }
       $data["page_title"]="Import Vendors";
       $data["import_btn"]="Import Vendors";
       return view("admin/vendors/import")->with("error","No data to confirm");
    }
    public function saveImportVendor_confirm(Request $request){
        $data=[];
        $valid_array=false;
        $this->validate($request,[
            "vendor_confirm"=>"required",
            "vendor_confirm.*.email"=>"required|email|unique:vestidos_vendors,email",
            "vendor_confirm.*.first_name"=>"required",
            "vendor_confirm.*.last_name"=>"required",
            "vendor_confirm.*.phone_number_1"=>"required",
            "vendor_confirm.*.address_1"=>"required",
            "vendor_confirm.*.city"=>"required",
            "vendor_confirm.*.state"=>"required",
            "vendor_confirm.*.country"=>"required",
        ]);
        $vendors = $request->input("vendor_confirm");
        foreach($vendors as $vendor){
            if(Arr::exists($vendor,"key")){
                $valid_array=true;
                $insert=[
                    "company_name"=>$vendor["company_name"],
                    "first_name"=>$vendor["first_name"],
                    "middle_name"=>$vendor["middle_name"],
                    "last_name"=>$vendor["last_name"],
                    "phone_number_1"=>$vendor["phone_number_1"],
                    "phone_number_2"=>$vendor["phone_number_2"],
                    "email"=>$vendor["email"],
                    "address_1"=>$vendor["address_1"],
                    "address_2"=>$vendor["address_2"],
                    "city"=>$vendor["city"],
                    "state"=>$vendor["state"],
                    "country_id"=>$vendor["country"],
                    "zip_code"=>$vendor["zip_code"],
                    "status"=>1,
                    "ip_address"=>$request->ip(),
                    "created_at"=>carbon::now(),
                ];

                 Vendors::insert($insert);
            }
        }
        if(!$valid_array){
            return redirect()->back()->withErrors(["required"=>"You must select a vendor"]);
        }else{
            Session::forget("data_confirm");
            return redirect()->route("admin_vendors")->with("success","import successfully entered");
        }
     }
}
