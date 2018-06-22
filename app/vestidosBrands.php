<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosBrands extends Model
{
    //
    public function getStatus($brand_id){
        $brand = DB::table("vestidos_brands as b")
                    ->select("s.name")
                    ->join("vestidos_status as s","b.status","=","s.id")
                    ->whereRaw("b.id='{{$brand_id}}'")
                    ->get();
        return $brand;
    }
}
