<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosStyles extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
