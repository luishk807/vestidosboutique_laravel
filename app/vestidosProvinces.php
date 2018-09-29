<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProvinces extends Model
{
    //
    public function country(){
        return $this->belongsTo('App\vestidosCountries',"country_id");
    }
    public function districts(){
        return $this->hasMany('App\vestidosDistricts',"province_id");
    }
}
