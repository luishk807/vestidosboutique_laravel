<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosShippingLists extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'total',
        'status',
        'created_at',
        'updated_at'
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
