<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductRates extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id","id");
    }
    public function user(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
}
