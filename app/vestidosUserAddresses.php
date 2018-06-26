<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosUserAddresses extends Model
{
    //
    public function getUser(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getFullName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
