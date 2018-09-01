<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosPaymentHistories extends Model
{
    //
    protected $fillable = [
        'order_id',
        'user_id',
        'transaction_id',
        'payment_method',
        'credit_card_type',
        'credit_card_number',
        'payment_status',
        'ip',
        'created_at',
        'updated_at'
    ];
    
    public function getUser(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getOrder(){
        return $this->belongsTo('App\vestidosOrders',"order_id");
    }
}
