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
         ->select("vestidos_vendors.id as id","vestidos_vendors.company_name as col_1","vestidos_vendors.first_name as col_2",
          "status.name as col_3",
          "country.countryCode as col_4")
         ->join("vestidos_statuses as status","status.id","vestidos_vendors.status")
         ->join("vestidos_countries as country","country.id","vestidos_vendors.country_id")
         ->whereIn('vestidos_vendors.id',$id_list)
         ->groupBy("vestidos_vendors.id")
         ->get();
         return $products;
     }
    public function getFullVendorName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
