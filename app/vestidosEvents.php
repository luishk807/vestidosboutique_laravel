<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
         $products = DB::table("vestidos_events")
         ->select("vestidos_events.*")
         ->whereIn('vestidos_events.id',$id_list)
         ->groupBy("vestidos_events.id")
         ->get();
         return $products;
     }
}
