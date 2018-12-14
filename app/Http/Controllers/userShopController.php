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
use App\vestidosConfigSectionShopBanners as ShopBanners;
use App\vestidosProductCategories as ProductsCategories;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;

class userShopController extends Controller
{
    //
    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users, ShopBanners $shop_banners,ProductsCategories $product_categories)
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
      $this->product_categories = $product_categories;
      $this->sort_options=array("low"=>__('pagination.sort_options.low_price'),"high"=>__('pagination.sort_options.high_price'));
    }
    public function index(){
        $data=[];
        $data["page_title"]=__('header.shop');
        $data["sort"]="low";
        $data["shop_banners"]=$this->shop_banners->first();
        $products = $this->products->orderBy('products_name');
        $data["products"]=$products->where("status",1)->paginate(15);
        $data["sort_ops"]=$this->sort_options;
        $data["categoryids"]=array();
        $data["brandids"]=array();
        $data["products_model"]=new Products;
        return view("shop",$data);
    }
    // function sortOption($data){
    //     $products = $this->products;
    //     if(isset($categories) && sizeof($categories)>0){
    //         $products = $this->products->getProductByEvents($categories);
    //     }
    //     if(isset($brands) && sizeof($brands)>0){
    //         $products = $products->whereIn("brand_id",$brands);
    //     }
    //     $products = $products->getProductsBySortOptions($neddle);
    //     return $products;
    // }
    public function sort_page_submit(Request $request){
        $data=[];
        $eventIn=[];
        $brandIn=[];
        $productIn=[];
        $sort = $request->input("shopPage_select");
        $data["page_title"]=__('header.shop');
        $data["sort"]=$sort;
        $data["sort_ops"]=$this->sort_options;
        $data["shop_banners"]=$this->shop_banners->first();
        $data["products_model"]=new Products;
        if($request->has('products_list')){
            $products_lists = $request->input('products_list');
            foreach($products_lists as $products_list){
                $productIn[]=$products_list;
            }
        }
        $data_list = [
            "sort"=>$sort,
            "products"=>$productIn,
            "events"=>null,
            "brands"=>null
        ];
        if($request->isMethod('post')){
            if($request->has('vestidos_events')){
                $events = $request->get('vestidos_events');
                foreach($events as $event){
                    $eventIn[]=$event;
                }
            }
            if($request->has('vestidos_brands')){
                $brands = $request->get('vestidos_brands');
                foreach($brands as $brand){
                    $brandIn[]=$brand;
                }
            }

            $data["eventids"]=$eventIn;
            $data["brandids"]=$brandIn;
            $data_list["events"]=$eventIn;
            $data_list["brands"]=$brandIn;
            // $products=$this->products->getProductsBySortOptions($data_list);
            $products=$this->products->wherein("id",$data_list["products"]);
            switch($data_list["sort"]){
                case "brand":
                $products->orderBy("brand_id.name");
                break;
                case "low":
                $products->with("vestidos_sizes")->orderBy("vestidos_sizes.total_sale","asc");
                break;
                case "high":
                $products->with("vestidos_sizes")->orderBy("vestidos_sizes.total_sale","desc");
                break;
                default:
                $products->orderBy("products_name");
                break;
            }
           $data["products"]=$products->paginate(15);
           // return view("shop",$data);
            dd($products);
        }
        $products=$this->products->getProductsBySortOptions($data_list);
        $data["products"]=$products;
       return view("shop",$data);
    }
    // public function sort_page(Request $request){
    //     $data=[];
    //     $data["categoryids"]=array();
    //     $data["brandids"]=array();
    //     $sort = $request->get("sort");
    //     $data["brands"]=$this->brands->all();
    //     $data["categories"]=$this->categories->all();
    //     $data["page_title"]="Shop";
    //     $data["sort"]=$request->get("sort");
    //     $data["sort_ops"]=array("name","brand","low","high");
    //     $data["shop_banners"]=$this->shop_banners->first();
    //     $products = $this->products->all;
    //     $products=$this->sortOption($sort,array(),array());
    //     $data["products"]=$products->paginate(15);
    //     return view("shop",$data);
    // }
}
