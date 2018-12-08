<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosColors extends Model
{
    //
    protected $fillable = [
        "product_id",
        "name",
        "color_code",
        "status",
        "created_at",
        "updated_at"
    ];
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function sizes(){
        return $this->hasMany('App\vestidosSizes',"color_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getClosuresByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_closures")
         ->select("vestidos_closures.*")
         ->whereIn('vestidos_closures.id',$id_list)
         ->groupBy("vestidos_closures.id")
         ->get();
         return $products;
     }
}
