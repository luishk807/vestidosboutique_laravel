<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("order_id")->unsigned()->nullable();
            $table->foreign("order_id")->references("id")->on("vestidos_orders")->onDelete("cascade");
            $table->integer("user_id")->unsigned()->nullable();
            $table->foreign("user_id")->references("id")->on("vestidos_users")->onDelete("set null");
            $table->text("transaction_id")->nullable();
            $table->string("payment_method")->nullable();
            $table->string("credit_card_type")->nullable();
            $table->integer("credit_card_number")->nullable();
            $table->string("payment_status")->nullable();
            $table->decimal('total')->nullable();
            $table->text("ip");
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
        Schema::dropIfExists('vestidos_payment_histories');
    }
}
