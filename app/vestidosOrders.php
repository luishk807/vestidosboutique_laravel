<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vestidosOrders extends Model
{
    //
    protected $fillable = [
        'user_id',
        "order_number",
        "purchase_date",
        "shipping_date",
        "delivered_date",
        "order_total",
        "order_tax",
        "order_shipping",
        "order_shipping_type",
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
    public function paymentHistories(){
        return $this->hasMany('App\vestidosPaymentHistories','order_id');
    }
    public function cancelOrder(){
        return $this->hasOne('App\vestidoOrderCancelReason','id','cancel_reason');
    }
    public function client(){
        return $this->belongsTo('App\vestidosUsers',"user_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function products(){
        return $this->hasMany('App\vestidosOrdersProducts',"order_id");
    }
    public function getOrderAddress(){
        return $this->hasMany('App\vestidosOrderAddresses','order_id');
    }
    public function getOrderShippingAddress(){
        $address = DB::table('vestidosOrderAddress')
                   ->select("vestidosOrderAddress.*")
                   ->where("address_type",1)
                   ->get();
        return $address;
    }
    public function getOrderBillingAddress(){
        $address = DB::table('vestidosOrderAddress')
                   ->select("vestidosOrderAddress.*")
                   ->where("address_type",2)
                   ->get();
        return $address;
    }
}
