<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUsers extends Model
{
    //
    public function orders(){
        return $this->hasMany('App\vestidosOrders',"user_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getFullName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
    public function rates(){
        return $this->hasMany('App\vestidosProductRates',"user_id");
    }
    public function getAddresses(){
        return $this->hasMany('App\vestidosUserAddresses',"user_id");
    }
}
