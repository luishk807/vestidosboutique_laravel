<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosOrdersProducts extends Model
{
    //
    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "status",
        "created_at",
        "updated_at"
    ];
    public function getOrderInfo(){
        return $this->belongsTo('App\vestidosOrders',"order_id");
    }
    public function getProduct(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
