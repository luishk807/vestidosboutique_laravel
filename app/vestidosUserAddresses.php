<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserAddresses extends Model
{
    //
    public function getUser(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getFullName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getCountry(){
        return $this->belongsTo('App\vestidosCountries',"country_id","id");
    }
    public function getAddressType(){
        return $this->belongsTo('App\vestidosAddressTypes',"address_type","id");
    }
}
