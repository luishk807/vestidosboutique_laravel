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
        "shipping_name",
        "shipping_address_1",
        "shipping_address_2",
        "shipping_city",
        "shipping_state",
        "shipping_country",
        "shipping_zip_code",
        "shipping_phone_number_1",
        "shipping_phone_number_2",
        "shipping_email",
        "billing_name",
        "billing_address_1",
        "billing_address_2",
        "billing_city",
        "billing_state",
        "billing_country",
        "billing_zip_code",
        "billing_phone_number_1",
        "billing_phone_number_2",
        "billing_email",
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
