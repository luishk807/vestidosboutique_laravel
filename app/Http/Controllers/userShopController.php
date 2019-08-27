<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as vestidosCountries;
use App\vestidosUsers as Users;
use App\vestidosEvents as Events;
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
    public function __construct(Products $products, vestidosCountries $countries, Brands $brands, Categories $categories, Addresses $addresses, Genders $genders, Languages $languages, Users $users, ShopBanners $shop_banners,ProductsCategories $product_categories, Events $events)
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
      $this->events = $events;
      $this->product_categories = $product_categories;
      $this->data_list = array(
        "sort"=>null,
        "events"=>null,
        "brands"=>null,
        "products"=>null,
        "type"=>array(
            "type"=>null,
            "id"=>null
        )
      );
      $this->sort_options=array("low"=>__('pagination.sort_options.low_price'),"high"=>__('pagination.sort_options.high_price'),"newest"=>__('pagination.sort_options.newest'));
    }
    public function index($type=null,$type_id = null){
        $data=[];
        if(isset($type) && isset($type_id)){
            $this->data_list["type"]["type"]=$type;
            $this->data_list["type"]["id"]=$type_id;
        }
        $event = $this->events->find($type_id);
        $data["page_title"]=__('header.shop');
        $data["sort"]="low";
        $data["event"]=$event;
        $products = $this->products->getProductsBySortOptions($this->data_list);
        $data["products"]=$products;
        $data["evtid"]=$type_id;
        $data["evtype"]=$type;
        $data["sort_ops"]=$this->sort_options;
        $data["products_model"]=new Products;
        return view("shop",$data);
    }
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
        if($request->has('product_lists')){
            $productLists = $request->get('product_lists');
            foreach($productLists as $productList){
                $productIn[]=$productList;
            }
            $this->data_list["products"]=$productIn;
        }
        $this->data_list["sort"] = $sort;
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
            $data_list["events"]=$eventIn;
            $data_list["brands"]=$brandIn;
            $products=$this->products->getProductsBySortOptions($this->data_list);
            $data["products"]=$products;
            return view("shop",$data);
        }
        $products=$this->products->getProductsBySortOptions($this->data_list);
        $data["products"]=$products;
       return view("shop",$data);
    }
    public function sort_product_list($type=null,$type_id = null,$sort_option){
        $data=[];
        if(isset($type) && isset($type_id)){
            $this->data_list["type"]["type"]=$type;
            $this->data_list["type"]["id"]=$type_id;
        }
        $this->data_list["sort"] =$sort_option;
        $event = $this->events->find($type_id);
        $data["page_title"]=__('header.shop');
        $data["sort"]=$sort_option;
        $data["event"]=$event;
        $products=$this->products->getProductsBySortOptions($this->data_list);
        $data["products"]=$products;
        $data["sort_ops"]=$this->sort_options;
        $data["products_model"]=new Products;
        $data["type"]=$type;
        $data["id"]=$type_id;
        $data["evtid"]=$type_id;
        $data["evtype"]=$type;
        return view("shop",$data);
    }
}
