<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosOrders extends Model
{
    //
    protected $fillable = ['user_id'];
    
    public function client(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function products(){
        return $this->hasMany('App\vestidosOrdersProducts',"order_id");
    }
    public function getShippingAddress(){
        return $this->hasOne('App\vestidosUserAddresses','id','ship_address_id');
    }
}
