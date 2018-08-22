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
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address_1')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('shipping_phone_number_1')->nullable();
            $table->string('shipping_phone_number_2')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_address_1')->nullable();
            $table->string('billing_address_2')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_zip_code')->nullable();
            $table->string('billing_phone_number_1')->nullable();
            $table->string('billing_phone_number_2')->nullable();
            $table->string('billing_email')->nullable();
            $table->decimal('order_total')->nullable();
            $table->decimal('order_tax')->nullable();
            $table->integer('order_shipping_type')->unsigned()->nullable();
            $table->foreign("order_shipping_type")->references("id")->on("vestidos_shipping_lists")->onDelete('set null');
            $table->decimal('order_shipping')->nullable();
            $table->text('transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('credit_card_type')->nullable();
            $table->integer('credit_card_number')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('ip');
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
