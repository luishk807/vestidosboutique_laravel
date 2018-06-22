<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosVendors extends Model
{
    //
    public function products(){
        return $this->hasMany('App\vestidosProducts');
    }
}
