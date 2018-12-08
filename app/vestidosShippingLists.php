<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosShippingLists extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'total',
        'status',
        'created_at',
        'updated_at'
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getShippingListsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_shipping_lists as shipping")
         ->select("shipping.id","shipping.name as col_1",
         "status.name as col_2","shipping.created_at as col_3","shipping.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","shipping.status")
         ->whereIn('shipping.id',$id_list)
         ->groupBy("shipping.id")
         ->get();
         return $products;
     }
}
