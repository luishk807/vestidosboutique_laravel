<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosProducts extends Model
{
    //
    public function images(){
        return $this->hasMany('App\vestidosProductsImg');
    }
    public function colors(){
        return $this->hasMany('App\vestidosColors');
    }
    public function rates(){
        return $this->hasMany('App\vestidosProductRates');
    }
    public function vendor(){
        return $this->belongsTo('App\vestidosVendors',"vendor_id","id");
    }
    public function searchProductsByLabels($filter){
        $products = DB::table("vestidos_products as prod")
                                    ->select("
                                        prod.products_name as name,
                                        prod.product_stock,
                                        prod.products_description as description, 
                                        img.img_url,
                                        img.img_name,
                                        brand.name
                                    ")
                                    ->join("vestidos_products_img as img","img.id","=","prod.products_img")
                                    ->join("vestidos_brands as brand","brand.id","=","prod.brand_id")
                                    ->whereRaw("
                                        prod.search_labels like '%{$filter}%'
                                    ")
                                    ->orderBy("prod.products_name")
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