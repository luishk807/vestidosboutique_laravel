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
use App\vestidosConfigSectionShopBanners as ShopBanners;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;

class userShopController extends Controller
{
    //
    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users, ShopBanners $shop_banners)
    {
      $this->brands=$brands;
      $this->country=$countries->all();
      $this->categories = $categories;
      $this->users = $users;
      $this->products=$products;
      $this->genders=$genders;
      $this->languages=$languages;
      $this->addresses=$addresses;
      $this->shop_banners = $shop_banners;
    }
    public function index(){
        $data=[];
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Shop";
        $data["sort"]="name";
        $data["shop_banners"]=$this->shop_banners->first();
        $products = $this->products->orderBy('products_name');
        $data["products"]=$products->paginate(15);
        $data["sort_ops"]=array("name","brand","low","high");
        return view("shop",$data);
    }
    function sortOption($neddle, $categories, $brands){
        $products = $this->products;
        if(sizeof($categories)>0){
            $products = $products->whereIn("category_id",$categories);
        }
        if(sizeof($brands)>0){
            $products = $products->whereIn("brand_id",$brands);
        }
        switch($neddle){
            case "brand":
            $products = $products->orderBy("brand_id");
            break;
            case "low":
            $products = $products->orderBy("product_total","asc");
            break;
            case "high":
            $products = $products->orderBy("product_total","desc");
            break;
            default:
            $products = $products->orderBy("products_name");
            break;
        }
        return $products;
    }
    public function sort_page_submit(Request $request){
        $data=[];
        $sort = $request->get("sort");
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Shop";
        $data["sort"]=$request->get("sort");
        $data["sort_ops"]=array("name","brand","low","high");
        $data["shop_banners"]=$this->shop_banners->first();
        if($request->isMethod('post')){
            $categoryIn =array();
            $brandIn=array();
            $sort = $request->input("shopPage_select_input");

            if($request->has('vestidos_categories')){
                $categories = $request->get('vestidos_categories');
                foreach($categories as $category){
                    $categoryIn[]=$category;
                }
            }
            if($request->has('vestidos_brands')){
                $brands = $request->get('vestidos_brands');
                foreach($brands as $brand){
                    $brandIn[]=$brand;
                }
            }
            $products=$this->sortOption($sort,$categoryIn,$brandIn);
            $data["products"]=$products->paginate(15);
             return view("shop",$data);
        }
        $products=$this->sortOption($sort,null,null);
        $data["products"]=$products->paginate(15);
        return view("shop",$data);
    }
    public function sort_page(Request $request){
        $data=[];
        $sort = $request->get("sort");
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["page_title"]="Shop";
        $data["sort"]=$request->get("sort");
        $data["sort_ops"]=array("name","brand","low","high");
        $data["shop_banners"]=$this->shop_banners->first();
        $products = $this->products->all;
        $products=$this->sortOption($sort,array(),array());
        $data["products"]=$products->paginate(15);
        return view("shop",$data);
    }
}