<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProductsRestocks extends Model
{
    //
    protected $fillable = [
        "product_id",
        "vendor_id",
        "color",
        "size",
        "quantity",
        "restock_date",
        "created_at",
    ];
    public function product(){
        return $this->belongsTo('App\vestidosProducts',"product_id");
    }
    public function color(){
        return $this->belongsTo('App\vestidosColors',"color");
    }
    public function size(){
        return $this->belongsTo('App\vestidosSizes',"size");
    }
    public function vendor(){
        return $this->belongsTo('App\vestidosVendors',"vendor_id","id");
    }
}
