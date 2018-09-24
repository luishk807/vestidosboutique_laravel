<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosUserAddresses as Addresses;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use App\vestidosProvinces as Provinces;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use Auth;

class userAddressController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Users $users, Statuses $statuses,Addresses $addresses, Countries $countries,Brands $brands, Categories $categories, Provinces $provinces){
        $this->statuses=$statuses;
        $this->addresses=$addresses;
        $this->countries=$countries;
        $this->provinces=$provinces;
        $this->users = $users;
        $this->brands=$brands;
        $this->categories = $categories;
        $this->addresstypes = $addresstypes;
    }
    function newAddress(Request $request){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $data["user_id"]=$user_id;
        $data["nick_name"]=$request->input("nick_name");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number_1"]=$request->input("phone_number_1");
        $data["email"]=$request->input("email");
        $data["address_1"]=$request->input("address_1");
        $data["address_2"]=$request->input("address_2");
        $data["city"]=$request->input("city");
        $city = $request->input("city");
        $data["country_id"]=(int)$request->input("country");
        $data["zip_code"]=$request->input("zip_code");
        $data["status"]=(int)$request->input("status");
        $data["state"]=$request->input("state");
        $data["address_type"]=(int)$request->input("address_type");
        $data["ip_address"]=$request->ip();
        $data["province"]=$request->input("province");

        $province_required=$request->input('province_required');
        $province_id=null;
        if($province_required=="true"){
            $province_id=$request->input("province");
            $province=$this->provinces->find($province_id);
            $city=null;
            $state=null;
            $rules=[
                "nick_name"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "zip_code"=>"required"
            ];
        }else{
            $city=$request->input("city");
            $state=$request->input("state");
            $rules=[
                "nick_name"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "zip_code"=>"required",
                "address_type"=>"required",
                "city"=>"required",
                "state"=>"required"
            ];
        }
        $data["state"] = $state;
        $data["city"] = $city;
        $data["province"] = $province_id;

        if($request->isMethod("post")){
            $this->validate($request,$rules);
            $data["status"]=1;
            $data["created_at"]=carbon::now();
            $this->addresses->insert($data);
            return redirect()->route("user_account",['user_id'=>$user_id]);
        }
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["addresstypes"]=$this->addresstypes->all();
        $data["country"]=$request->input("country");
        $data["province_required"]=$province_required;
        $data["page_title"]=__('general.user_section.create_address');
        $data["statuses"]=$this->statuses->all();
        $data["countries"]=$this->countries->all();
        $data["provinces"]=$this->provinces->all();
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("account/address/new",$data);
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

        $province=$this->provinces->find($request->input("province"));
        $province_required=$request->input("province_required");
        
        $province_id=null;
        if($province_required=="true"){
            $province_id=$request->input("province");
            $province=$this->provinces->find($province_id);
            $city=null;
            $state=null;
            $rules=[
                "nick_name"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "zip_code"=>"required"
            ];
        }else{
            $city=$request->input("city");
            $state=$request->input("state");
            $rules=[
                "nick_name"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "zip_code"=>"required",
                "city"=>"required",
                "state"=>"required"
            ];
        }
        $data["state"] = $state;
        $data["city"] = $city;
        $data["province"] = $province_id;
        
        $data["zip_code"]=$request->input("zip_code");
        $address = $this->addresses->find($address_id);
        $user_id = $address->user_id;

        if($request->isMethod("post")){
            $this->validate($request,$rules);
            $address->nick_name = $request->input("nick_name");
            $address->first_name = $request->input("first_name");
            $address->address_type = $request->input("address_type");
            $address->middle_name = $request->input("middle_name");
            $address->last_name = $request->input("last_name");
            $address->phone_number_1 = $request->input("phone_number_1");
            $address->email = $request->input("email");
            $address->address_1 = $request->input("address_1");
            $address->address_2 = $request->input("address_2");
            $address->city = $city;
            $address->province=$province_id;
            $address->state = $state;
            $address->country_id = (int)$request->input("country");
            $address->zip_code = $request->input("zip_code");
            $address->updated_at = carbon::now();
            $address->save();
            return redirect()->route("user_account",['user_id'=>$user_id]);
        }
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["user_id"]=$user_id;
        $data["country"]=$request->input("country");
        $data["province_required"]=$province_required;
        $data["provinces"]=$this->provinces->all();
        $data["addresstypes"]=$this->addresstypes->all();
        $data["address"]=$address;
        $data["page_title"]= __('general.user_section.edit_address',['name'=>$address->nick_name]);
        $data["address_id"]=$address_id;
        $data["statuses"]=$this->statuses->all();
        $data["countries"]=$this->countries->all();
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("account/address/edit",$data);
    }
    public function deleteAddress($address_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $address = $this->addresses->find($address_id);
            $address->delete();
            return redirect()->route("user_account",["user_id"=>$address->user_id]);
        }
        $address = $this->addresses->find($address_id);
        $data["address"]=$address;
        $data["country"]=$request->input("country");
        $data["categories"]=$this->categories->all();
        $data["brands"]=$this->brands->all();
        $data["user"]=$this->users->find($address->user_id);
        $data["user_id"] = $address->user_id;
        $data["page_title"]=__('general.user_section.delete_address');
        return view("account/address/confirm",$data);
    }
}
