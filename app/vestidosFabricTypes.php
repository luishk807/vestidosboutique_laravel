<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosFabricTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getFabricsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_fabric_types as fabric")
         ->select("fabric.id","fabric.name as col_1",
         "status.name as col_2","fabric.created_at as col_3","fabric.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","fabric.status")
         ->whereIn('fabric.id',$id_list)
         ->groupBy("fabric.id")
         ->get();
         return $products;
     }
}
