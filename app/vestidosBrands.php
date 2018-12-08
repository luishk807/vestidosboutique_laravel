<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosBrands extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getProducts(){
        return $this->hasMany('App\vestidosProducts',"brand_id");
    }
    public function getBrandsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_brands as brand")
         ->select("brand.id","brand.name as col_1",
         "status.name as col_2","brand.created_at as col_3","brand.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","brand.status")
         ->whereIn('brand.id',$id_list)
         ->groupBy("brand.id")
         ->get();
         return $products;
     }
}
