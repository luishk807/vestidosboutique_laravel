<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vestidosProducts extends Model
{
    //
    public function images(){
        return $this->hasMany("App/vestidosProductsImg");
    }
    public function colors(){
        return $this->hasMany("App/vestidosColors");
    }
    public function rates(){
        return $this->hasMany("App/vestidosProductRates");
    }
    public function vendor(){
        return $this->belongsTo("App/vestidosVendors","vendor_id","id");
    }
}
