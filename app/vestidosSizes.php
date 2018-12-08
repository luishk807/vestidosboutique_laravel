<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosSizes extends Model
{
    //
    protected $fillable = [
        "color_id",
        "name",
        "status",
        "total_sale",
        "total_sale_old",
        "is_sell",
        "total_rent",
        "total_rent_old",
        "is_rent",
        "stock",
        "created_at",
        "updated_at"
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getProduct(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getColor(){
        return $this->belongsTo('App\vestidosColors',"color_id");
    }
    public function getSizesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_sizes as size")
         ->select("size.id","size.name as col_1",
         "status.name as col_2","size.created_at as col_3","size.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","size.status")
         ->whereIn('size.id',$id_list)
         ->groupBy("size.id")
         ->get();
         return $products;
     }
    
}
