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
         $products = DB::table("vestidos_brands")
         ->select("vestidos_brands.*")
         ->whereIn('vestidos_brands.id',$id_list)
         ->groupBy("vestidos_brands.id")
         ->get();
         return $products;
     }
}
