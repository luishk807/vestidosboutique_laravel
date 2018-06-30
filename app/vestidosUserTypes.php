<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserType extends Model
{
    //
    public function getUsers(){
        return $this->belongsTo('App\vestidosUsers','user_type');
    }
}
