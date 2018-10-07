<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosLengthTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
