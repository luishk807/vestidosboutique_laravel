<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductsRestocks extends Model
{
    //
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function vendor(){
        return $this->belongsTo('App\vestidosVendors',"vendor_id","id");
    }
}
