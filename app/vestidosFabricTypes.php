<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosFabricTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
