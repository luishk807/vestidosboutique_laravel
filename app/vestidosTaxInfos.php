<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosTaxInfos extends Model
{
    //
    public function getCountry(){
        return $this->belongsTo('App\vestidosCountries',"country_id","id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getTaxesByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_tax_infos")
         ->select("vestidos_tax_infos.id as id","vestidos_tax_infos.code as col_1","vestidos_tax_infos.tax as col_2",
          "status.name as col_3",
          "country.countryCode as col_4")
         ->join("vestidos_statuses as status","status.id","vestidos_tax_infos.status")
         ->join("vestidos_countries as country","country.id","vestidos_tax_infos.country_id")
         ->whereIn('vestidos_tax_infos.id',$id_list)
         ->groupBy("vestidos_tax_infos.id")
         ->get();
         return $products;
     }
}
