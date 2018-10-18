<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use App\vestidosUserWishlists as Wishlists;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Input;
use Auth;

class userWishlistController extends Controller
{
    //
    public function __construct(Wishlists $wishlists, Users $users){
        $this->users = $users;
        $this->wishlists=$wishlists;
    }
    public function index(){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["page_title"]=__('header.wishlists');
        $data["user"]=$user;
        $data["user_id"]=$user_id;
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
