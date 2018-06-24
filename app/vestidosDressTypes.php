<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosDressTypes extends Model
{
    //
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getDressType(){
        return $this->belongsTo('App\vestidosDressTypes',"dress_type_id");
    }
    public function getDressStyle(){
        return $this->belongsTo('App\vestidosStyles',"dress_style_id");
    }
}
