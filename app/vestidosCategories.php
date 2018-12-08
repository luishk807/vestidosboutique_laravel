<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
         $products = DB::table("vestidos_categories")
         ->select("vestidos_categories.*")
         ->whereIn('vestidos_categories.id',$id_list)
         ->groupBy("vestidos_categories.id")
         ->get();
         return $products;
     }
}
