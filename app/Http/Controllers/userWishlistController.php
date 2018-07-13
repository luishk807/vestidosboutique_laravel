<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosUsers as Users;
use App\vestidosUserWishlists as Wishlists;
use App\vestidosBrands as Brands;
use App\vestidosCountries as Countries;
use App\vestidosCategories as Categories;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Input;
use Auth;

class userWishlistController extends Controller
{
    //
    public function __construct(Countries $countries,Brands $brands, Statuses $statuses, Wishlists $wishlists, Users $users, Categories $categories){
        $this->users = $users;
        $this->statuses=$statuses;
        $this->countries = $countries;
        $this->wishlists=$wishlists;
        $this->brands=$brands;
        $this->categories = $categories;
    }
    public function index($user_id){
        $data=[];
        $data["page_title"]="Wishlists";
        $data["user"]=$this->users->find($user_id);
        $data["user_id"]=$user_id;
        $data["wishlists"]=$this->wishlists->all();
        return view("/account/wishlists/home",$data);
    }
    public function addWishlist(){
        $data=[];
        $product_id=Input::get('data');
        if(Auth::guard("vestidosUsers")->check()){
            $data["user_id"]=Auth::guard("vestidosUsers")->user()->getId();
            $data["product_id"]=$product_id;
            $data["created_at"]=carbon::now();
            $this->wishlists->insert($data);
            return "Good";
        }else{
           return "error:";
        }
    }
    public function deleteWishlist($wishlist_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
           $wishlist = $this->wishlists->find($wishlist_id);
           foreach($wishlist->images as $image){
                $img_path =public_path().'/images/wishlists/'.$image->img_url;
                if(file_exists($img_path)){
                    @unlink($img_path);
                }
            }
            $wishlist->delete();
            return redirect()->route("admin_wishlists");
        }
        $data["wishlist"]=$this->wishlists->find($wishlist_id);
        $data["page_title"]="Delete wishlist";
        return view("admin/wishlists/confirm",$data);
    }
}
