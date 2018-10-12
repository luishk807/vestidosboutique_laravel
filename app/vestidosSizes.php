<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosSizes extends Model
{
    //
    protected $fillable = [
        "color_id",
        "name",
        "status",
        "created_at",
        "updated_at"
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getProduct(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    
}
