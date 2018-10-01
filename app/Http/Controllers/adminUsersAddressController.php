<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosUserAddresses as Addresses;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosCountries as Countries;
use App\vestidosProvinces as Provinces;
use App\vestidosDistricts as Districts;
use App\vestidosCorregimientos as Corregimientos;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;

class adminUsersAddressController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Users $users, Statuses $statuses,Addresses $addresses, Countries $countries,Provinces $provinces, Districts $districts, Corregimientos $corregimientos){
        $this->statuses=$statuses;
        $this->addresses=$addresses;
        $this->countries=$countries;
        $this->provinces=$provinces;
        $this->districts=$districts;
        $this->corregimientos=$corregimientos;
        $this->users = $users;
        $this->addresstypes = $addresstypes;
    }
    function index(){
        $data=[];

        $data["countries"]=$this->countries->all();
        $data["addresses"]=$this->addresses->all();
        $data["page_title"]="Address Page";
        return view("admin/users/addresses/home",$data);
    }
    function newAddress($user_id,Request $request){
        $data=[];
        $data["user_id"]=$user_id;
        $data["nick_name"]=$request->input("nick_name");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number_1"]=$request->input("phone_number_1");
        $data["email"]=$request->input("email");
        $data["address_1"]=$request->input("address_1");
        $data["address_2"]=$request->input("address_2");
        $data["province_id"]=$request->input("province");
        $data["district_id"]=$request->input("district");
        $data["corregimiento_id"]=$request->input("corregimiento");
        $data["country_id"]=$request->input("country");
        $data["zip_code"]=$request->input("zip_code");
        $data["status"]=(int)$request->input("status");
        $data["address_type"]=(int)$request->input("address_type");
        $data["ip_address"]=$request->ip();
        if($request->isMethod("post")){
            $this->validate($request,[
                "nick_name"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "district"=>"required",
                "province"=>"required",
                "corregimiento"=>"required",
                "zip_code"=>"required",
                "address_type"=>"required",
                "status"=>"required",
            ]);
            $data["created_at"]=carbon::now();
            $this->addresses->insert($data);
            return redirect()->route("admin_address",["user_id"=>$user_id]);
        }
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["addresstypes"]=$this->addresstypes->all();
        $data["province"]=$request->input("province");
        $data["district"]=$request->input("district");
        $data["corregimiento"]=$request->input("corregimiento");
        $data["country"]=$request->input("country");
        $data["page_title"]="Create Address Page For ".$user->getFullName();
        $data["statuses"]=$this->statuses->all();
        $data["provinces"]=$this->provinces->all();
        $data["countries"]=$this->countries->all();
        return view("admin/users/addresses/new",$data);
    }
    function editAddress($address_id, Request $request){
        $data=[];
        $data["nick_name"]=$request->input("nick_name");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number_1"]=$request->input("phone_number_1");
        $data["email"]=$request->input("email");
        $data["address_1"]=$request->input("address_1");
        $data["address_2"]=$request->input("address_2");
        $data["province"]=$request->input("province");
        $data["district"]=$request->input("district");
        $data["corregimiento"]=$request->input("corregimiento");
        $data["country"]=$request->input("country");
        $data["zip_code"]=$request->input("zip_code");
        $data["status"]=(int)$request->input("status");
        $address = $this->addresses->find($address_id);
        $user_id = $address->user_id;
        if($request->isMethod("post")){
            $this->validate($request,[
                "nick_name"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "district"=>"required",
                "province"=>"required",
                "corregimiento"=>"required",
                "zip_code"=>"required",
                "status"=>"required",
            ]);
            $address->nick_name = $request->input("nick_name");
            $address->first_name = $request->input("first_name");
            $address->address_type = $request->input("address_type");
            $address->middle_name = $request->input("middle_name");
            $address->last_name = $request->input("last_name");
            $address->phone_number_1 = $request->input("phone_number_1");
            $address->email = $request->input("email");
            $address->address_1 = $request->input("address_1");
            $address->address_2 = $request->input("address_2");
            $address->province_id = $request->input("province");
            $address->corregimiento_id = $request->input("corregimiento");
            $address->district_id = $request->input("district");
            $address->country_id = (int)$request->input("country");
            $address->zip_code = $request->input("zip_code");
            $address->status = (int)$request->input("status");
            $address->updated_at = carbon::now();
            $address->save();
            return redirect()->route("admin_address",['user_id'=>$user_id]);
        }
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["user_id"]=$user_id;
        $data["country"]=$request->input("country");
        $data["addresstypes"]=$this->addresstypes->all();
        $data["address"]=$address;
        $data["page_title"]="Edit Address ".$user->getFullName();
        $data["provinces"]=$this->provinces->all();
        $data["districts"]=$this->districts->where("province_id",$address->province_id)->get();
        $data["corregimientos"]=$this->corregimientos->where("districts_id",$address->district_id)->get();
        $data["address_id"]=$address_id;
        $data["statuses"]=$this->statuses->all();
        $data["countries"]=$this->countries->all();
        return view("admin/users/addresses/edit",$data);
    }
    public function deleteAddress($address_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $address = $this->addresses->find($address_id);
            $address->delete();
            return redirect()->route("admin_address",["user_id"=>$address->user_id]);
        }
        $address = $this->addresses->find($address_id);
        $data["address"]=$address;
        $data["user_id"] = $address->user_id;
        $data["page_title"]="Delete Address";
        return view("admin/users/addresses/confirm",$data);
    }
}
