<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosDressTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
