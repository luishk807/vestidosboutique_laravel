<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosCountries extends Model
{
    //
    public function provinces(){
        return $this->hasMany('App\vestidosProvinces',"country_id");
    }
}
