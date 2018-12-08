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
    public function getPaymentsByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_payment_types as payment")
         ->select("payment.id","payment.name as col_1",
         "status.name as col_2","payment.created_at as col_3","payment.updated_at as col_4")
         ->join("vestidos_statuses as status","status.id","payment.status")
         ->whereIn('payment.id',$id_list)
         ->groupBy("payment.id")
         ->get();
         return $products;
     }
}
