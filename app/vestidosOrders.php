<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosOrders extends Model
{
    //
    protected $fillable = [
        'user_id',
        "order_number",
        "purchase_date",
        "shipping_date",
        "delivered_date",
        "ship_address_id",
        "bill_address_id",
        "order_total",
        "order_tax",
        "order_shipping",
        "transaction_id",
        "payment_method",
        "credit_card",
        "credit_card_number",
        "payment_status",
        "ip",
        "status",
        "created_at",
        "updated_at"
    ];
    
    public function client(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function products(){
        return $this->hasMany('App\vestidosOrdersProducts',"order_id");
    }
    public function getShippingAddress(){
        return $this->hasOne('App\vestidosUserAddresses','id','ship_address_id');
    }
}
