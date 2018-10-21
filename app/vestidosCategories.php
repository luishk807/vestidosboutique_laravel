<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosCategories extends Model
{
    //
    public function products(){
        return $this->hasMany('App\vestidosProducts',"category_id");
    }
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
