<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosOrdersProducts extends Model
{
    //
    public function getOrderInfo(){
        return $this->belongsTo('App\vestidosOrders',"order_id");
    }
}
