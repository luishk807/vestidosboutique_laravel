<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductTypes extends Model
{
    //
    public function getCategory(){
        return $this->belongsTo('App\vestidosCategories',"category_id");
    }
    public function products(){
        return $this->hasMany('App\vestidosProducts',"product_type_id");
    }
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getProductTypesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_product_types as type")
         ->select("type.id","type.name as col_1",
         "status.name as col_2","type.created_at as col_3","type.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","type.status")
         ->whereIn('type.id',$id_list)
         ->groupBy("type.id")
         ->get();
         return $products;
     }
}
