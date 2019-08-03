<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\vestidosMainConfigs as MainConfig;
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use App\vestidosTaxInfos as Taxes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Session; 

class userCartController extends Controller
{
    //
    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users,Colors $colors, Sizes $sizes, Taxes $taxes, MainConfig $main_config)
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
      $this->main_config = $main_config->first();
      $this->tax_info = $taxes->first();
      $this->taxes=$taxes;
    }
    public function index(){
        $data=[];
        $data["page_title"]=__('header.cart');
        $cart = Session::get("vestidos_shop");
        $tax_amt = $this->tax_info->tax / 100;
        $cart_remove="";
        if(!empty($cart)){
            for($i=0;$i<sizeof($cart);$i++){
                $product = $this->products->find($cart[$i]["id"]);
                // if($cart[$i]["stock"] < 1){
                //     $cart_remove .= empty($cart_remove) ? $cart[$i]["name"]:" ,".$cart[$i]["name"];
                //    array_splice($cart,$i,1);
                // }else{
                //     $cart[$i]["stock"]=$cart[$i]["stock"];
                // }
                $cart[$i]["stock"]=$cart[$i]["stock"];
            }
        }
        
        if(!empty($cart_remove)){
            $cart_remove .=" ".__('general.removed');
            Session::flash("alert",$cart_remove);
        }
        Session::forget("vestidos_shop");
        Session::put("vestidos_shop",$cart);
        $data["prev_shop"]=str_replace(url('/'), '', url()->previous());
        $data["subtotal"]=0;
        $data["tax_info"]=$this->tax_info;
        $data["tax"]=$tax_amt;
        return view("cart",$data);
    }
    public function addToCart($product_id,Request $request){
        $data=[];
        $data["product"]=$this->products->find($product_id);
        $data["page_title"]=__('header.cart');
        $cart = Session::get("vestidos_shop");
        $product = $this->products->find($product_id);
        $quantity = (int) $request->input("product_quantity");
        $color_id = (int)$request->input("product_color");
        $color = $this->colors->find($color_id);
        $size_id = (int)$request->input("product_size");
        $size = $this->sizes->find($size_id);
        $tax_amt = $this->tax_info->tax / 100;
        $found=false;
        if(Session::has("vestidos_shop")){
          $cart=Session::get("vestidos_shop");
          for($i=0;$i<sizeof($cart);$i++){
             if($cart[$i]["id"]==$product_id && $cart[$i]["color"]==$color->name && $cart[$i]["size"]==$size->name){
                 $cart[$i]["quantity"] =$cart[$i]["quantity"] + $quantity;
                 Session::flash("success",__('general.cart_title.item_updated'));
                 $found=true;
                 break;
             }
          }
        }
        if(!$found){
            $image_save = $product->images->count() > 0 ? $product->getMainImage()[0]->img_url : "no-image.jpg";
            $cart[]=array(
                "id"=>$product->id,
                "name"=>$product->products_name,
                "image"=>$image_save,
                "model"=>$product->product_model,
                "detail"=>$product->product_detail,
                "quantity"=>$quantity,
                "color"=>$color->name,
                "color_id"=>$color_id,
                "size"=>$size->name,
                "size_id"=>$size_id,
                "stock"=>$size->stock,
                "total"=>$size->total_sale,
                "total_old"=>$size->total_sale_old
            ); 
            Session::flash("success",__('general.cart_title.item_added'));
        }
        $data["subtotal"]=0;
        $data["tax"]=$tax_amt;
       //dd($cart);
        Session::put("vestidos_shop",$cart);
        return redirect()->route("cart_page");
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
                Session::flash("success",__('general.cart_title.cart_updated'));
                
            }else{
                Session::flash("error",__('general.cart_title.cart_error'));
            }
        }else{
            Session::flash("error",__('general.cart_title.cart_error'));
        }
        return redirect()->route("cart_page");
    }
    public function cart_delete(){
        $key=(int) Input::get('key');
        if(Session::has("vestidos_shop")){
            $cart = Session::get("vestidos_shop");
            if(isset($cart[$key])){
                Session::flash("success",__('general.cart_title.item_removed',['name'=>$cart[$key]["name"]]));
                array_splice($cart,$key,1);
                Session::forget("vestidos_shop");
                Session::put("vestidos_shop",$cart);
                return redirect()->route("cart_page");
            }else{
                Session::flash("error",__('general.cart_title.cart_error'));
            }
        }else{
            Session::flash("error",__('general.cart_title.cart_error'));
        }
        return redirect()->route("cart_page");
    }
}
