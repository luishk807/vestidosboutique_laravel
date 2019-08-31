<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosMainConfigs extends Model
{
    //
    public function getPopUp(){
        return $this->belongsTo('App\vestidosAlerts',"alert_id");
    }
}
