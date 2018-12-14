<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosStyles extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getDressStylesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_styles as style")
         ->select("style.id","style.name as col_1",
         "status.name as col_2","style.created_at as col_3","style.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","style.status")
         ->whereIn('style.id',$id_list)
         ->groupBy("style.id")
         ->get();
         return $products;
     }
}
