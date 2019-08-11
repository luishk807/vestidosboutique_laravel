<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosProductRates extends Model
{
    //
    protected $fillable = [
        'user_id',
        'product_id',
        'user_headline',
        'user_comment',
        'status',
        'created_at',
        'updated_at'
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id","id");
    }
    public function user(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getRatesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_product_rates as rate")
         ->select("rate.id","rate.name as col_1",
         "status.name as col_2","rate.created_at as col_3","rate.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","rate.status")
         ->whereIn('rate.id',$id_list)
         ->groupBy("rate.id")
         ->get();
         return $products;
     }
}
