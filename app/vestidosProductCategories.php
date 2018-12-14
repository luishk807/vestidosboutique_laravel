<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosProductCategories extends Model
{
    //
    public function getProduct(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getCategory(){
        return $this->belongsTo('App\vestidosCategories',"category_id");
    }
    public function getCategoriesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_product_categories as category")
         ->select("category.id","category.name as col_1",
         "status.name as col_2","category.created_at as col_3","category.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","category.status")
         ->whereIn('category.id',$id_list)
         ->groupBy("category.id")
         ->get();
         return $products;
     }
}
