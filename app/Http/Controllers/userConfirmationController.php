<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use Illuminate\Support\Facades\Hash;
use Auth;

class userConfirmationController extends Controller
{
    //
    public function __construct(Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
    }
    public function accountCreationConfirm(){
        $data["page_title"]="thank You";
        $data["thankyou_title"]="Account Created";
        $data["thankyou_msg"]="Your account is successfully created";
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function accountCreationError(){
        $data["page_title"]="Ops!";
        $data["thankyou_title"]="Ops! Account Not Created";
        $data["thankyou_msg"]="An unexpected issue ocurred, please try again later";
        $data["thankyou_img"]="close_2.svg";
        $data["thankyou_status"]=false;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function logoutConfirm(){
        $data["page_title"]="Logout Page";
        $data["thankyou_title"]="Logout Successfull";
        $data["thankyou_msg"]="You have succesfully logout";
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function orderCreationCreated(){
        $data["page_title"]="Order Received";
        $data["thankyou_title"]="Order Received";
        $data["thankyou_msg"]="Success: Your order has been created";
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
}
