<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAdddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_order_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign("order_id")->references("id")->on("vestidos_orders")->onDelete("cascade");
            $table->integer('address_type')->unsigned()->nullable();
            $table->foreign("address_type")->references("id")->on("vestidos_address_types")->onDelete("set null");
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('province')->nullable();
            $table->string('corregimiento')->nullable();
            $table->string('district')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code');
            $table->string('phone_number_1');
            $table->string('phone_number_2')->nullable();
            $table->string('email');
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
        Schema::dropIfExists('vestidos_order_addresses');
    }
}
