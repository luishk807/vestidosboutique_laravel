<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserTypes extends Model
{
    //
    public function getUsers(){
        return $this->belongsTo('App\vestidosUsers','user_type');
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
