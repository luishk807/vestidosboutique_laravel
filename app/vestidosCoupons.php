<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosCoupons extends Model
{
    //
    protected $fillable = [
        'short_desc',
        'code',
        'description',
        'exp_date',
        'discount',
        "status",
        "created_at",
        "updated_at"
    ];
    protected $rules = [
        'code' => 'sometimes|required|code|unique:vestidosCoupons',
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getCouponsByIds($ids){
        $id_list =[];
        foreach($ids as $id){
            $id_list[]=$id;
        }
        $products = DB::table("vestidos_coupons as coupon")
        ->select("coupon.id","coupon.code as col_1",
        "status.name as col_2","coupon.created_at as col_3","coupon.updated_at as col_4")
        ->join("vestidos_statuses as status","status.id","coupon.status")
        ->whereIn('coupon.id',$id_list)
        ->groupBy("coupon.id")
        ->get();
        return $products;
    }
}
