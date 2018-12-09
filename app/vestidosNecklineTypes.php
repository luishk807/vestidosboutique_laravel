<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosNecklineTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getNecklinesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_neckline_types as neckline")
         ->select("neckline.id","neckline.name as col_1",
         "status.name as col_2","neckline.created_at as col_3","neckline.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","neckline.status")
         ->whereIn('neckline.id',$id_list)
         ->groupBy("neckline.id")
         ->get();
         return $products;
     }
}
