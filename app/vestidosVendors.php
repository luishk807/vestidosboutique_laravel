<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class vestidosVendors extends Model
{
    //
    public function products(){
        return $this->hasMany('App\vestidosProducts',"vendor_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getVendorsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_vendors")
         ->select("vestidos_vendors.*")
         ->whereIn('vestidos_vendors.id',$id_list)
         ->groupBy("vestidos_vendors.id")
         ->get();
         return $products;
     }
    public function getFullVendorName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
