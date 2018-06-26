<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserAddresses extends Model
{
    //
    public function getUser(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
}
