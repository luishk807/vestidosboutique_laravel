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
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign("user_id")->references("id")->onDelete('set null')->on("vestidos_users");
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign("product_id")->references("id")->onDelete('set null')->on("vestidos_products");
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('shipping_date')->nullable();
            $table->integer('ship_address_id')->unsigned()->nullable();
            $table->foreign("ship_address_id")->references("id")->onDelete('set null')->on("vestidos_user_address");
            $table->integer('bill_address_id')->unsigned()->nullable();
            $table->foreign("bill_address_id")->references("id")->onDelete('set null')->on("vestidos_user_address");
            $table->integer('order_quantity')->nullable();
            $table->decimal('order_total')->nullable();
            $table->decimal('order_tax')->nullable();
            $table->decimal('order_shipping')->nullable();
            $table->text('ip');
            $table->integer('status')->unsigned()->nullable();
            $table->foreign("status")->references("id")->onDelete('set null')->on("vestidos_statuses");
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
