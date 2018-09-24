<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserAddresses extends Model
{
    //
    protected $fillable = [
        'user_id',
        "address_type",
        "nick_name",
        "first_name",
        "middle_name",
        "last_name",
        "address_1",
        "address_2",
        "city",
        "state",
        "country_id",
        "zip_code",
        "phone_number_1",
        "phone_number_2",
        "email",
        "province",
        "status",
        "ip_address",
        "created_at",
        "updated_at"
    ];
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
    public function getProvince(){
        return $this->belongsTo('App\vestidosProvinces',"province");
    }
    public function getAddressType(){
        return $this->belongsTo('App\vestidosAddressTypes',"address_type","id");
    }
}
