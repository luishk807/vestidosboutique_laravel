<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUsers extends Model
{
    //
    public function orders(){
        return $this->hasMany("App/vestidosOrders");
    }
}
