<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosSizes extends Model
{
    //
    protected $fillable = [
        "color_id",
        "name",
        "status",
        "total_sale",
        "total_sale_old",
        "is_sell",
        "total_rent",
        "total_rent_old",
        "is_rent",
        "stock",
        "created_at",
        "updated_at"
    ];
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getProduct(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    
}
