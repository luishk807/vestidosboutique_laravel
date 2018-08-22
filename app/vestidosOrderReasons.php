<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosOrderReasons extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
