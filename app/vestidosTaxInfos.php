<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosTaxInfos extends Model
{
    //
    public function getCountry(){
        return $this->belongsTo('App\vestidosCountries',"country_id","id");
    }
}
