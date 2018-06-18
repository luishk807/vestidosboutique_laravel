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
        Schema::create('vestidos_status_user_adddress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('address_type');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('state');
            $table->integer('country_id');
            $table->string('postal_code');
            $table->string('phone_number_1');
            $table->string('phone_number_2');
            $table->string('email');
            $table->text('ip_address');
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
        Schema::dropIfExists('vestidos_status_user_adddress');
    }
}
