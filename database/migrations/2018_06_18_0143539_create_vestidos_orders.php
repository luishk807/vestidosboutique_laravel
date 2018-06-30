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
            $table->foreign("user_id")->references("id")->on("vestidos_users")->onDelete('cascade');
            $table->integer('order_number')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign("product_id")->references("id")->on("vestidos_products")->onDelete('set null');
            $table->date('purchase_date')->nullable();
            $table->date('shipping_date')->nullable();
            $table->integer('ship_address_id')->unsigned()->nullable();
            $table->foreign("ship_address_id")->references("id")->on("vestidos_user_addresses")->onDelete('set null');
            $table->integer('bill_address_id')->unsigned()->nullable();
            $table->foreign("bill_address_id")->references("id")->on("vestidos_user_addresses")->onDelete('set null');
            $table->integer('order_quantity')->nullable();
            $table->decimal('order_total')->nullable();
            $table->decimal('order_tax')->nullable();
            $table->decimal('order_shipping')->nullable();
            $table->text('ip');
            $table->integer('status')->unsigned()->nullable();
            $table->foreign("status")->references("id")->on("vestidos_statuses")->onDelete('set null');
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
