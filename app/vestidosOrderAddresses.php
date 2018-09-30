<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosOrderAddresses extends Model
{
    //
    public function getCountry(){
        return $this->belongsTo('App\vestidosCountries',"country_id","id");
    }
    public function getProvince(){
        return $this->belongsTo('App\vestidosProvinces',"province_id");
    }
    public function getDistrict(){
        return $this->belongsTo('App\vestidosDistricts',"district_id");
    }
    public function getCorregimiento(){
        return $this->belongsTo('App\vestidosCorregimientos',"corregimiento_id");
    }
    public function getAddressType(){
        return $this->belongsTo('App\vestidosAddressTypes',"address_type","id");
    }
}
