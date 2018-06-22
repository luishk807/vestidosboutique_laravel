<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosOrders extends Model
{
    //
    public function client(){
        return $this->belongsTo('App\vestidosUsers',"user_id","id");
    }
}
