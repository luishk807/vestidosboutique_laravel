<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosUserAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references("id")->on("vestidos_users")->onDelete('cascade');
            $table->integer('address_type');
            $table->string('nick_name')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
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
            $table->text('ip_address');
            $table->integer('status')->default(1)->unsigned()->nullable();
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
        Schema::dropIfExists('vestidos_user_addresses');
    }
}
