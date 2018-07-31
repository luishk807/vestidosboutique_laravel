<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserWishlists extends Model
{
    //
    public function getUser(){
        return $this->belongsTo('App/vestidosUsers',"user_id","id");
    }
    public function getProduct(){
        return $this->belongsTo('App/vestidosProducts',"product_id");
    }
}
