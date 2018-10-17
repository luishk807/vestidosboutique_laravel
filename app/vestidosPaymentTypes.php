<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosPaymentTypes extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
}
