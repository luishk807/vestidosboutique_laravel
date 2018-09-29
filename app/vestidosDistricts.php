<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosDistricts extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function provinces(){
        return $this->belongsTo('App\vestidosProvinces',"province_id");
    }
    public function corregimientos(){
        return $this->hasMany('App\vestidosCorregimientos',"districts_id","id");
    }
}
