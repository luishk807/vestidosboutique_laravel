<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosConfigSectionTopQuincesses extends Model
{
    //
    public function product(){
        return $this->hasMany('App\vestidosProducts',"product_id");
    }
}
