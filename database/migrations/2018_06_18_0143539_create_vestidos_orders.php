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
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references("id")->on("vestidos_users");
            $table->integer('product_id')->unsigned();
            $table->foreign("product_id")->references("id")->on("vestidos_products");
            $table->dateTime('purchase_date');
            $table->dateTime('shipping_date');
            $table->integer('ship_address_id')->unsigned();
            $table->foreign("ship_address_id")->references("id")->on("vestidos_user_address");
            $table->integer('bill_address_id')->unsigned();
            $table->foreign("bill_address_id")->references("id")->on("vestidos_user_address");
            $table->integer('order_quantity');
            $table->decimal('order_total');
            $table->decimal('order_tax');
            $table->decimal('order_shipping');
            $table->text('ip');
            $table->integer('status')->unsigned();
            $table->foreign("status")->references("id")->on("vestidos_statuses");
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
