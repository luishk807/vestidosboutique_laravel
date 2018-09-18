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
        $data["page_title"]=__('general.thank_you');
        $data["thankyou_title"]=__('general.page_header.account_created');
        $data["thankyou_msg"]=__('general.user_section.account_created');
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function accountCreationError(){
        $data["page_title"]=__('general.page_header.ops');
        $data["thankyou_title"]=__('general.page_header.account_not_created');
        $data["thankyou_msg"]=__('general.user_section.account_not_created');
        $data["thankyou_img"]="close_2.svg";
        $data["thankyou_status"]=false;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function logoutConfirm(){
        $data["page_title"]=__('general.page_header.logout');
        $data["thankyou_title"]=__('auth.logout_title');
        $data["thankyou_msg"]=__('auth.logout_msg');
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function orderCreationCreated(Request $request){
        $data["page_title"]=__('general.page_header.order_received');
        $data["thankyou_title"]=__('general.order_section.order_received');
        $data["thankyou_msg"]=__('general.order_section.order_success_created');
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
    public function resetPasswordSent(){
        $data["page_title"]=__('general.forgot_password.confirm_title');
        $data["thankyou_title"]=__('general.forgot_password.confirm_title');
        $data["thankyou_msg"]=__('general.forgot_password.confirm_msg');
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/confirmation",$data);
    }
}
