<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductTypes extends Model
{
    //
    public function getCategory(){
        return $this->belongsTo('App\vestidosCategories',"category_id");
    }
    public function products(){
        return $this->hasMany('App\vestidosProducts',"product_type_id");
    }
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
