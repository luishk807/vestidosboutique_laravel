<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountCodeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vestidos_orders', function (Blueprint $table) {
            //
            $table->integer('coupon_id')->after("order_shipping")->unsigned()->nullable();
            $table->foreign("coupon_id")->references("id")->on("vestidos_coupons")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vestidos_orders', function (Blueprint $table) {
            //
            $table->dropColumn('coupon_id');
        });
    }
}
