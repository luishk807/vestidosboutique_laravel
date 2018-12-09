<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosEvents extends Model
{
    //
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getEventsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_events as event")
         ->select("event.id","event.name as col_1",
         "status.name as col_2","event.created_at as col_3","event.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","event.status")
         ->whereIn('event.id',$id_list)
         ->groupBy("event.id")
         ->get();
         return $products;
     }
}
