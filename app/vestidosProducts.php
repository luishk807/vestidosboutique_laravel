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
        "category_id",
        "product_type_id",
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
    public function getSize_byId($product_id){
        $prod=null;
        if(!empty($product_id)){
            $prod = DB::table("vestidos_sizes as sizes")
            ->join("vestidos_colors as colors","sizes.color_id","colors.id")
            ->where("colors.product_id",$product_id)->first();
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
        ->paginate(10);
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
    public function getProductByEvent($event_id){
        $products = DB::table("vestidos_products")
        ->select("vestidos_products.*",
        DB::raw('(select img_url from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_url'),
        DB::raw('(select img_name from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_name')
        )->join("vestidos_product_events","product_id","vestidos_products.id")
        ->where("vestidos_product_events.event_id",$event_id)->take(5)->get();
        return $products;
    }
    public function getProductByEvents($cat_ids){
        $products = DB::table("vestidos_products")
        ->select("vestidos_products.*")
        ->join("vestidos_product_events","product_id","vestidos_products.id")
        ->join("vestidos_colors as colors","colors.product_id","vestidos_products.id")
        ->join("vestidos_sizes as sizes","sizes.color_id","colors.id")
        ->whereIn("vestidos_product_events.event_id",$cat_ids)
        ->groupBy("colors.id");
        return $products;
    }
    public function getProductsBySortOptions($data){
        $sort = $data["sort"];
        $products = DB::table("vestidos_products as products")
        ->select("products.*","brands.name as brand_name","colors.name as color_name","events.event_id as event_id","sizes.name as size_name","sizes.total_sale as total_sale")
        ->join("vestidos_colors as colors","colors.product_id","products.id")
        ->join("vestidos_vendors as vendors","vendors.id","products.vendor_id")
        ->join("vestidos_brands as brands","brands.id","products.brand_id")
        ->join("vestidos_sizes as sizes","sizes.color_id","colors.id")
        ->join("vestidos_product_events as events","events.product_id","products.id")
        ->where("products.status",1);
        if(isset($data["brands"]) && sizeof($data["brands"])>0){
            $products->whereIn("products.brand_id",$data["brands"]);
        }
        if(isset($data["events"]) && sizeof($data["events"])>0){
            $products->whereIn("events.id",$data["events"]);
        }
        if(isset($data["type"]["type"]) && isset($data["type"]["id"])){
            switch($data["type"]["type"]){
                case "style":
                $products->where("products.style",$data["type"]["id"]);
                break;
                case "type":
                $products->where("products.product_type_id",$data["type"]["id"]);
                break;
                case "event":
                $products->where("events.event_id",$data["type"]["id"]);
                break;
            }

        }
        if(isset($data["products"]) && sizeof($data["products"])>0){
            $products->whereIn("products.id",$data["products"]);
        }
        switch($sort){
            case "brand":
            $products->orderBy("brands.name");
            break;
            case "low":
            $products->orderBy("total_sale","asc");
            break;
            case "high":
            $products->orderBy("total_sale","desc");
            break;
            default:
            $products->orderBy("products_name");
            break;
        }
        $products = $products->groupBy("products.id")->paginate(15);
       //dd($products);
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
    public function getProductsByIds($ids){
       $id_list =[];
        foreach($ids as $id){
            $id_list[]=$id;
        }

        $products = DB::table("vestidos_products")
        ->select("vestidos_products.products_name as col_2","vestidos_products.id as id",
        DB::raw('(select img_url from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as col_1')
        ,"brands.name as col_3","category.name as col_4")
        ->join("vestidos_product_events","product_id","vestidos_products.id")
        ->join("vestidos_brands as brands","brands.id","vestidos_products.brand_id")
        ->join("vestidos_categories as category","category.id","vestidos_products.category_id")
        ->whereIn('vestidos_products.id',$id_list)
        ->groupBy("vestidos_products.id")
        ->get();
       // dd($products);
        return $products;
    }
    public function getPopularProduct(){
        $this_year = date("Y");
        $start_date = $this_year."-01-01 00:00:00";
        $end_date = $this_year."-12-31 00:00:00";
        $popular_dresses = DB::table('vestidos_orders_products as order')
        ->select(DB::raw("COUNT(*) as y"),"product.products_name as name")
        ->whereBetween('order.created_at',[$start_date,$end_date])
        ->join("vestidos_products as product","product.id","order.product_id")
        ->limit(10)
        ->groupBy("order.size_id")
        ->orderBy("y","desc")
        ->get()->toArray();
        $popular_dresses = json_encode($popular_dresses,JSON_NUMERIC_CHECK);

        return $popular_dresses;
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
    public function searchProductsByString($filter){
        $model_search = strtoupper($filter);
        $products = DB::table("vestidos_products")
        ->select("vestidos_products.*",
        DB::raw('(select img_url from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_url'),
        DB::raw('(select img_name from vestidos_products_imgs where product_id=vestidos_products.id order by id limit 1) as image_name')
        ,"brands.name as brand_name","status.name as status_name")
        ->join("vestidos_brands as brands","brands.id","vestidos_products.brand_id")
        ->join("vestidos_statuses as status","status.id","vestidos_products.status")
        ->whereRaw("vestidos_products.search_labels like '%{$filter}%'")
        ->orWhereRaw("vestidos_products.products_name like '%{$filter}%'")
        ->orWhere("vestidos_products.product_model",$model_search)
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
    public function getCategory(){
        return $this->belongsTo('App\vestidosCategories',"category_id");
    }
    public function getStyle(){
        return $this->belongsTo('App\vestidosStyles',"style");
    }
    public function getBrand(){
        return $this->belongsTo('App\vestidosBrands',"brand_id");
    }
    public function getProductType(){
        return $this->belongsTo('App\vestidosProductTypes',"product_type_id");
    }
    public function events(){
        return $this->hasMany('App\vestidosProductEvents',"product_id");
    }
}
