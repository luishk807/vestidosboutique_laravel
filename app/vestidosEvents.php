<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosEvents extends Model
{
    //
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
