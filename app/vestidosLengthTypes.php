<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosLengthTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getLengthsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_length_types as length")
         ->select("length.id","length.name as col_1",
         "status.name as col_2","length.created_at as col_3","length.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","length.status")
         ->whereIn('length.id',$id_list)
         ->groupBy("length.id")
         ->get();
         return $products;
     }
}
