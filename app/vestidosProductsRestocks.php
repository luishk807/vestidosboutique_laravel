<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductsRestocks extends Model
{
    //
    protected $fillable = [
        "product_id",
        "vendor_id",
        "color",
        "size",
        "quantity",
        "restock_date",
        "created_at",
    ];
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getColor(){
        return $this->belongsTo('App\vestidosColors',"color");
    }
    public function getSize(){
        return $this->belongsTo('App\vestidosSizes',"size");
    }
    public function vendor(){
        return $this->belongsTo('App\vestidosVendors',"vendor_id","id");
    }
    public function getRestocksByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_products_restocks as restock")
         ->select("restock.id","restock.name as col_1",
         "status.name as col_2","restock.created_at as col_3","restock.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","restock.status")
         ->whereIn('restock.id',$id_list)
         ->groupBy("restock.id")
         ->get();
         return $products;
     }
}
