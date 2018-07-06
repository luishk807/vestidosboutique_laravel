<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosUsers as Users;
use App\vestidosUserWishlists as Wishlists;
use Carbon\Carbon as carbon;

class userWishlistController extends Controller
{
    //
    public function __construct(Statuses $statuses, Wishlists $wishlists, Users $users){
        $this->users = $users;
        $this->statuses=$statuses;
        $this->wishlists=$wishlists;
    }
    public function index($user_id){
        $data=[];
        $data["page_title"]="Wishlists";
        $data["user"]=$this->users->find($user_id);
        $data["user_id"]=$user_id;
        $data["wishlists"]=$this->wishlists->all();
        return view("/account/wishlists/home",$data);
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
