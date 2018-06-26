<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosVendors as Vendors;
use App\vestidosCountries as Countries;
use Carbon\Carbon as carbon;

class adminUsersAddressController extends Controller
{
    //
    public function __construct(Statuses $statuses, Vendors $vendors, Countries $countries){
        $this->statuses=$statuses;
        $this->vendors=$vendors;
        $this->countries=$countries;
    }
    function index(){
        $data=[];
        $data["countries"]=$this->countries->all();
        $data["vendors"]=$this->vendors->all();
        $data["page_title"]="VendorPage";
        return view("admin/vendors/home",$data);
    }
    function newVendors(Request $request){
        $data=[];
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
                "email"=>"required",
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
        $data["statuses"]=$this->statuses->all();
        $data["countries"]=$this->countries->all();
        return view("admin/vendors/new",$data);
    }
    function editVendor($vendor_id, Request $request){
        $data=[];
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
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "city"=>"required",
                "state"=>"required",
                "zip_code"=>"required",
                "status"=>"required",
            ]);
            
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
        $data["statuses"]=$this->statuses->all();
        $data["countries"]=$this->countries->all();
        return view("admin/vendors/new",$data);
    }
    public function deleteVendor($vendor_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $product = $this->vendor->find($vendor_id);
            $vendor->delete();
            return redirect()->route("admin_vendors");
        }
        $data["vendor"]=$this->vendor->find($vendor_id);
        $data["page_title"]="Delete Vendor";
        return view("admin/vendors/confirm",$data);
    }
}
