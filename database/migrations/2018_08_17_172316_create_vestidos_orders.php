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
            $table->text('order_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->decimal('order_total')->nullable();
            $table->decimal('order_total_refund')->nullable();
            $table->date('order_refund_date')->nullable();
            $table->decimal('order_tax')->nullable();
            $table->integer('order_shipping_type')->unsigned()->nullable();
            $table->foreign("order_shipping_type")->references("id")->on("vestidos_shipping_lists")->onDelete('set null');
            $table->decimal('order_shipping')->nullable();
            $table->integer('payment_type')->unsigned()->nullable();
            $table->foreign("payment_type")->references("id")->on("vestidos_payment_types")->onDelete('set null');
            $table->text('ip');
            $table->integer('cancel_reason')->unsigned()->nullable();
            $table->foreign("cancel_reason")->references("id")->on("vestidos_order_cancel_reasons")->onDelete('set null');
            $table->integer('cancel_user')->unsigned()->nullable();
            $table->foreign("cancel_user")->references("id")->on("vestidos_users")->onDelete('set null');
            $table->integer('status')->default(9)->unsigned()->nullable();
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
