<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosCorregimientos extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function district(){
        return $this->belongsTo('App\vestidosDistricts',"districts_id");
    }
}
