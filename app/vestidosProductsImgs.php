<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductsImgs extends Model
{
    //
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getImagesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_products_imgs as img")
         ->select("img.id","img.name as col_1",
         "status.name as col_2","img.created_at as col_3","img.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","img.status")
         ->whereIn('img.id',$id_list)
         ->groupBy("img.id")
         ->get();
         return $products;
     }
}
