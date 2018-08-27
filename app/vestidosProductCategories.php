<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductCategories extends Model
{
    //
    public function getProduct(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function getCategory(){
        return $this->belongsTo('App\vestidosCategories',"category_id");
    }
}
