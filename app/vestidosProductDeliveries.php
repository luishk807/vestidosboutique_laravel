<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosProductDeliveries extends Model
{
    protected $fillable = [
        'name',
        'description',
        'total',
        'main',
        'status',
        'created_at',
        'updated_at'
    ];
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getDeliveriesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_product_deliveries as delivery")
         ->select("delivery.id","delivery.name as col_1",
         "status.name as col_2","delivery.created_at as col_3","delivery.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","delivery.status")
         ->whereIn('delivery.id',$id_list)
         ->groupBy("delivery.id")
         ->get();
         return $products;
     }
}
