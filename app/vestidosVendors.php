<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosVendors extends Model
{
    //
    public function products(){
        return $this->hasMany('App\vestidosProducts',"vendor_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getFullVendorName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
