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
    public function index(){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["page_title"]="Wishlists";
        $data["user"]=$user;
        $data["user_id"]=$user_id;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["wishlists"]=$this->wishlists->all();
        return view("/account/wishlists/home",$data);
    }
    public function addWishlist(){
        $data=[];
        $product_id=Input::get('data');
        if(Auth::guard("vestidosUsers")->check()){
            $user_id = Auth::guard("vestidosUsers")->user()->getId();
            $data["user_id"]=$user_id;
            $data["product_id"]=$product_id;
            $data["created_at"]=carbon::now();

            $wishlist = $this->wishlists::where('product_id',$product_id)->where('user_id',$user_id)->get();
            if($wishlist->first()){
                $wishlist->first()->delete();
                // return "deleted";
                return ["status"=>"deleted","product_id"=>$product_id];
            }else{
                $this->wishlists->insert($data);
                
                // return "insert";
                return ["status"=>"insert","product_id"=>$product_id];
            }
        }else{
        //    return "login";
            return ["status"=>"login","product_id"=>null];
        }
    }
    public function deleteWishlist($wishlist_id){
        $data=[];
        $data["user_id"] = Auth::guard("vestidosUsers")->user()->getId();
        $wishlist = $this->wishlists->find($wishlist_id);
        $wishlist->delete();
        return redirect()->route('user_wishlists');
    }
}
