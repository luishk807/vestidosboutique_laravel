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
            $table->string('name');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->foreign("province_id")->references("id")->on("vestidos_provinces");
            $table->integer('corregimiento_id')->unsigned()->nullable();
            $table->foreign("corregimiento_id")->references("id")->on("vestidos_corregimientos");
            $table->integer('district_id')->unsigned()->nullable();
            $table->foreign("district_id")->references("id")->on("vestidos_districts");
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign("country_id")->references("id")->on("vestidos_countries");
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
