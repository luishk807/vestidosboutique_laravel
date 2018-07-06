<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserWishlists extends Model
{
    //
    public function getUser(){
        return $this->belongsTo('App/vestidosUsers',"user_id");
    }
}
