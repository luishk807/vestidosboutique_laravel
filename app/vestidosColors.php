<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function getColorsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_colors as color")
         ->select("color.id","color.name as col_1",
         "status.name as col_2","color.created_at as col_3","color.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","color.status")
         ->whereIn('color.id',$id_list)
         ->groupBy("color.id")
         ->get();
         return $products;
     }
}
