<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductRates extends Model
{
    //
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id","id");
    }
}
