<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosCategories extends Model
{
    //
    public function products(){
        return $this->hasMany('App\vestidosProducts',"category_id");
    }
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getCategoriesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_categories as category")
         ->select("category.id","category.name as col_1",
         "status.name as col_2","category.created_at as col_3","category.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","category.status")
         ->whereIn('category.id',$id_list)
         ->groupBy("category.id")
         ->get();
         return $products;
     }
}
