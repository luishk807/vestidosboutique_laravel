<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'total',
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
    public function getPaymentsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_payment_histories as payment")
         ->select("payment.id","payment.payment_method as col_1",
         "payment.total as col_2","users.first_name as col_3","payment.created_at as col_4","payment.order_id as col_5")
         ->join("vestidos_users as users","users.id","payment.user_id")
         ->whereIn('payment.id',$id_list)
         ->groupBy("payment.id")
         ->get();
         return $products;
     }
}
