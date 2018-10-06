<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosCategories extends Model
{
    //
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
