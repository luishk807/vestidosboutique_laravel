<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosProducts extends Model
{
    //
    public function images(){
        return $this->hasMany('App\vestidosProductsImgs',"product_id");
    }
    public function colors(){
        return $this->hasMany('App\vestidosColors',"product_id");
    }
    public function rates(){
        return $this->hasMany('App\vestidosProductRates',"product_id");
    }
    public function sizes(){
        return $this->hasMany('App\vestidosSizes',"product_id");
    }
    public function isWishList($user_id,$product_id){
        $wishlist = DB::table("vestidos_user_wishlists")
                    ->whereRaw("user_id = {$user_id} and product_id={$product_id}")
                    ->get();
        return $wishlist;
    }
    public function vendor(){
        return $this->belongsTo('App\vestidosVendors',"vendor_id","id");
    }
    public function getProductByCat($cat_id){
        $products = DB::table("vestidos_products")
        ->select("vestidos_products.*",
        DB::raw('(select img_url from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_url'),
        DB::raw('(select img_name from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_name')
        )
        ->where("vestidos_products.category_id",$cat_id)->take(5)->get();
        return $products;
    }
    public function searchProductsByLabels($filter){
        $products = DB::table("vestidos_products")
                                    ->select("vestidos_products.*",
                                    DB::raw('(select img_url from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_url'),
                                    DB::raw('(select img_name from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_name')
                                    )
                                    ->whereRaw("vestidos_products.search_labels like '%{$filter}%'")
                                    ->orderBy("vestidos_products.products_name")
                                    ->get();
        return $products;
    }
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getBrand(){
        return $this->belongsTo('App\vestidosBrands',"brand_id");
    }
    public function getCategory(){
        return $this->belongsTo('App\vestidosCategories',"category_id");
    }
}
