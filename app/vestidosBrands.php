<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosBrands extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
