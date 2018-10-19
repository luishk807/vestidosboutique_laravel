<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class vestidosProducts extends Model
{
    //
    protected $fillable = [
        "products_name",
        "product_model",
        "products_description",
        "brand_id",
        "product_closure_id",
        "product_detail",
        "product_fabric_id",
        "product_length",
        "product_neckline_id",
        "total_rent",
        "total_rent_old",
        "total_sale",
        "total_sale_old",
        "style",
        "is_rent",
        "is_sell",
        "is_new",
        "purchase_date",
        "search_labels",
        "top_dress",
        "top_quince",
        "vendor_id",
        "status",
        "created_at",
        "updated_at"
    ];
    public function getImages_byId($product_id){
        $prod=null;
        if(!empty($product_id)){
            $prod = DB::table("vestidos_products_imgs")->where('product_id',$product_id)->first();
        }
        return $prod;
    }
    public function getColors_byId($product_id){
        $prod=null;
        if(!empty($product_id)){
            $prod = DB::table("vestidos_colors")->where('product_id',$product_id)->take(2)->get();
        }
        return $prod;
    }
    public function getVendors_byId($vendor_id){
        $prod=null;
        if(!empty($vendor_id)){
            $prod = DB::table("vestidos_vendors")->where('id',$vendor_id)->get();
        }
        return $prod;
    }
    public function getRates_byId($product_id){
        $prod=null;
        if(!empty($product_id)){
            $prod = DB::table("vestidos_product_rates")->select( DB::raw("AVG(user_rate) as rates","id","product_id"))->where('product_id',$product_id)->get();
        }
        return $prod;
    }
    public function images(){
        return $this->hasMany('App\vestidosProductsImgs',"product_id");
    }
    public function colors(){
        return $this->hasMany('App\vestidosColors',"product_id");
    }
    public function rates(){
        return $this->hasMany('App\vestidosProductRates',"product_id");
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
    public function getRatesByStatus($status){
        $products = DB::table("vestidos_product_rates")
                    ->select("vestidos_product_rates.*")
                    ->where("status",$status)
                    ->where("product_id",$this->getKey())
                    ->get();
        return $products;
    }
    public function getAllSizesCount(){
        return DB::table("vestidos_sizes")
        ->select(DB::raw('count(vestidos_sizes.id) as count'))
        ->join("vestidos_colors","vestidos_colors.id","=","vestidos_sizes.color_id")
        ->join("vestidos_products","vestidos_products.id","=","vestidos_colors.product_id")
        ->where("vestidos_products.id",$this->getKey())
        ->get();
    }
    public function getAllSizes(){
        return DB::table("vestidos_sizes")
        ->select('vestidos_sizes.*',"vestidos_colors.name as color_name","vestidos_statuses.name as status_name")
        ->join("vestidos_colors","vestidos_colors.id","=","vestidos_sizes.color_id")
        ->join("vestidos_products","vestidos_products.id","=","vestidos_colors.product_id")
        ->join("vestidos_statuses","vestidos_statuses.id","=","vestidos_sizes.status")
        ->where("vestidos_products.id",$this->getKey())
        ->get();
    }
    public function is_rated(){
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $products = DB::table("vestidos_product_rates")
                    ->select("vestidos_product_rates.*")
                    ->where("product_id",$this->getKey())
                    ->where("user_id",$user_id)
                    ->exists();
        return $products;
    }
    public function getRateCountApproved(){
        $products = DB::table("vestidos_product_rates")
                    ->select("vestidos_product_rates.*")
                    ->where("product_id",$this->getKey())
                    ->where("status",1)
                    ->get();
        return $products;
    }
    public function getProductByCat($cat_id){
        $products = DB::table("vestidos_products")
        ->select("vestidos_products.*",
        DB::raw('(select img_url from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_url'),
        DB::raw('(select img_name from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_name')
        )->join("vestidos_product_categories","product_id","vestidos_products.id")
        ->where("vestidos_product_categories.category_id",$cat_id)->take(5)->get();
        return $products;
    }
    public function getProductByCats($cat_ids){
        $products = DB::table("vestidos_products")
        ->select("vestidos_products.*")
        ->join("vestidos_product_categories","product_id","vestidos_products.id")
        ->whereIn("vestidos_product_categories.category_id",$cat_ids);
        return $products;
    }
    public function getStock(){
        return DB::table("vestidos_sizes")
        ->select(DB::raw('sum(vestidos_sizes.stock) as stock'))
        ->join("vestidos_colors","vestidos_colors.id","=","vestidos_sizes.color_id")
        ->join("vestidos_products","vestidos_products.id","=","vestidos_colors.product_id")
        ->where("vestidos_products.id",$this->getKey())
        ->get();
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
    public function length(){
        return $this->belongsTo('App\vestidosLengthTypes',"product_length");
    }
    public function getBrand(){
        return $this->belongsTo('App\vestidosBrands',"brand_id");
    }
    public function categories(){
        return $this->hasMany('App\vestidosProductCategories',"product_id");
    }
}
