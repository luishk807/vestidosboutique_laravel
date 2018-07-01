<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosOrders extends Model
{
    //
    public function client(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getProducts(){
        return $this->hasMany('App\vestidosProducts',"id");
    }
}
