<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosCategories extends Model
{
    //
    public function getDressType(){
        return $this->belongsTo('App\vestidosDressTypes',"dress_type_id");
    }
    public function getDressStyle(){
        return $this->belongsTo('App\vestidosStyles',"dress_style_id");
    }
    public function getStatus(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
