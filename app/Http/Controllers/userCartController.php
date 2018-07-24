<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestEmail;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as vestidosCountries;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosProducts as Products;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosUserAddresses as Addresses;
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use App\vestidosTaxInfos as Taxes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Session; 

class userCartController extends Controller
{
    //
    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users,Colors $colors, Sizes $sizes, Taxes $taxes)
    {
      //  $this->middleware('auth');
      $this->brands=$brands;
      $this->country=$countries->all();
      $this->categories = $categories;
      $this->users = $users;
      $this->products=$products;
      $this->genders=$genders;
      $this->languages=$languages;
      $this->addresses=$addresses;
      $this->colors=$colors;
      $this->sizes=$sizes;
      $this->taxes=$taxes;
    }
    public function index(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Cart This";
        $cart = Session::get("vestidos_shop");
        $cart_subtotal=0;
        $tax = $this->taxes->find(1);
        $tax_amt = (float) $tax->tax;
        $cart_remove="";
        for($i=0;$i<sizeof($cart);$i++){
            $total = $cart[$i]["quantity"] * $cart[$i]["total"];
            $cart_subtotal += (int) $total;
            $product = $this->products->find($cart[$i]["id"]);
            if($product->product_stock < 1){
                $cart_remove .= empty($cart_remove) ? $cart[$i]["name"]:" ,".$cart[$i]["name"];
               array_splice($cart,$i,1);
            }else{
                $cart[$i]["stock"]=$product->product_stock;
            }
        }
        if(!empty($cart_remove)){
            $cart_remove .=" removed";
            Session::flash("alert",$cart_remove);
        }
        Session::forget("vestidos_shop");
        Session::put("vestidos_shop",$cart);
        $data["subtotal"]=$cart_subtotal;
        $data["tax"]=$tax_amt * $cart_subtotal;
        return view("cart",$data);
    }
    public function addToCart($product_id,Request $request){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["product"]=$this->products->find($product_id);
        $data["page_title"]="Cart";
        $cart = Session::get("vestidos_shop");
        $product = $this->products->find($product_id);
        $quantity = (int) $request->input("product_quantity");
        $color_id = (int)$request->input("product_color");
        $color = $this->colors->find($color_id);
        $size_id = (int)$request->input("product_size");
        $size = $this->sizes->find($size_id);
        $found=false;
        if(Session::has("vestidos_shop")){
          $cart=Session::get("vestidos_shop");
          for($i=0;$i<sizeof($cart);$i++){
             if($cart[$i]["id"]==$product_id && $cart[$i]["color"]==$request->input("product_color") && $cart[$i]["size"]==$request->input("product_size")){
                 $cart[$i]["quantity"] =$cart[$i]["quantity"] + $quantity;
                 Session::flash("success","Item Updated");
                 $found=true;
                 break;
             }
          }
        }
        if(!$found){
            $cart[]=array(
                "id"=>$product->id,
                "name"=>$product->products_name,
                "image"=>$product->images->first()->img_url,
                "model"=>$product->product_model,
                "detail"=>$product->product_detail,
                "quantity"=>$quantity,
                "color"=>$color->name,
                "size"=>$size->name,
                "stock"=>0,
                "total"=>$product->product_total,
                "total_old"=>$product->total_old
            ); 
            Session::flash("success","Item Added");
        }
        Session::put("vestidos_shop",$cart);
        return redirect()->back();
    }
    public function cart_save(){
        $key=(int) Input::get('key');
        $quantity=(int) Input::get('quantity');
        if(Session::has("vestidos_shop")){
            $cart = Session::get("vestidos_shop");
            if(isset($cart[$key]) && $quantity > 0){
                $cart[$key]["quantity"]=$quantity;
                Session::forget("vestidos_shop");
                Session::put("vestidos_shop",$cart);
                echo "success";
            }else{
                echo "error:".$key." and ".$quantity;
            }
        }else{
            echo "empty";
        }
    }
    public function cart_delete(){
        $key=(int) Input::get('key');
        if(Session::has("vestidos_shop")){
            $cart = Session::get("vestidos_shop");
            if(isset($cart[$key])){
                array_splice($cart,$key,1);
                Session::forget("vestidos_shop");
                Session::put("vestidos_shop",$cart);
                echo "success";
            }else{
                echo "error";
            }
        }else{
            echo "empty";
        }
    }
}
