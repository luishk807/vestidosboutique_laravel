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
        "payment_type",
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
    public function getPaymentType(){
        return $this->belongsTo('App\vestidosPaymentTypes',"payment_type");
    }
    public function getOrderShippingAddress(){
        $address = DB::table('vestidos_order_addresses')
                   ->select("vestidos_order_addresses.*","vestidos_provinces.name as province_name","vestidos_provinces.id as province_id","vestidos_districts.name as district_name","vestidos_districts.id as district_id",
                   "vestidos_corregimientos.name as corregimiento_name",
                   "vestidos_corregimientos.id as corregimiento_id", "vestidos_countries.countryCode as country_name", "vestidos_countries.id as country_id")
                   ->join("vestidos_provinces","vestidos_provinces.id","vestidos_order_addresses.province_id")
                   ->join("vestidos_districts","vestidos_districts.id","vestidos_order_addresses.district_id")
                   ->join("vestidos_corregimientos","vestidos_corregimientos.id","vestidos_order_addresses.corregimiento_id")
                   ->join("vestidos_countries","vestidos_countries.id","vestidos_order_addresses.country_id")
                   ->where("vestidos_order_addresses.address_type",1)
                   ->where("vestidos_order_addresses.order_id",$this->getKey())
                   ->get();
        return $address->toArray();
    }

    public function getTotalOrderYear(){
        $this_year = date("Y");
        $start_date = $this_year."-01-01 00:00:00";
        $end_date = $this_year."-12-31 00:00:00";
        $order_year = DB::table('vestidos_orders as order')
        ->select(DB::raw("COUNT(*) as count"))
        ->whereBetween('created_at',[$start_date,$end_date])
        ->orderBy("purchase_date")
        ->groupBy(DB::raw("MONTH(purchase_date)"))
        ->get()->toArray();

        $order_year = array_column($order_year, 'count');
        $order_year = json_encode($order_year,JSON_NUMERIC_CHECK);

        return $order_year;
    }

    public function getTotalOrderWeek(){
        $this_year = date("Y");
        $start_date = $this_year."-01-01 00:00:00";
        $end_date = $this_year."-12-31 00:00:00";
        $order_week = DB::table('vestidos_orders as order')
        ->select(DB::raw("COUNT(*) as count"))
        ->whereBetween('created_at',[$start_date,$end_date])
        ->orderBy("purchase_date")
        ->groupBy(DB::raw("WEEK(purchase_date)"))
        ->get()->toArray();
        $order_week = array_column($order_week, 'count');
        $order_week = json_encode($order_week,JSON_NUMERIC_CHECK);

        return $order_week;
    }
    public function getOrderBillingAddress(){
        $address = DB::table('vestidos_order_addresses')
                    ->select("vestidos_order_addresses.*","vestidos_provinces.name as province_name","vestidos_provinces.id as province_id","vestidos_districts.name as district_name","vestidos_districts.id as district_id",
                    "vestidos_corregimientos.name as corregimiento_name",
                    "vestidos_corregimientos.id as corregimiento_id", "vestidos_countries.countryCode as country_name", "vestidos_countries.id as country_id")
                    ->join("vestidos_provinces","vestidos_provinces.id","vestidos_order_addresses.province_id")
                    ->join("vestidos_districts","vestidos_districts.id","vestidos_order_addresses.district_id")
                    ->join("vestidos_corregimientos","vestidos_corregimientos.id","vestidos_order_addresses.corregimiento_id")
                    ->join("vestidos_countries","vestidos_countries.id","vestidos_order_addresses.country_id")
                   ->where("vestidos_order_addresses.address_type",2)
                   ->where("vestidos_order_addresses.order_id",$this->getKey())
                   ->get();
        return $address->toArray();
    }
}
