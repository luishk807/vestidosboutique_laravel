<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->dateTime('purchase_date');
            $table->dateTime('shipping_date');
            $table->integer('ship_address_id');
            $table->integer('bill_address_id');
            $table->integer('order_quantity');
            $table->decimal('order_total');
            $table->decimal('order_tax');
            $table->decimal('order_shipping');
            $table->text('ip');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vestidos_orders');
    }
}
