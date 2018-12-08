<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosClosureTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getClosuresByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_closure_types as closure")
         ->select("closure.id","closure.name as col_1",
         "status.name as col_2","closure.created_at as col_3","closure.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","closure.status")
         ->whereIn('closure.id',$id_list)
         ->groupBy("closure.id")
         ->get();
         return $products;
     }
}
