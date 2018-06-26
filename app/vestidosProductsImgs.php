<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductsImgs extends Model
{
    //
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}