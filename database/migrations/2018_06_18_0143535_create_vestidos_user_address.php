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
        Schema::create('vestidos_user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign("user_id")->references("id")->onDelete('set null')->on("vestidos_users");
            $table->integer('address_type');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('state');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign("country_id")->references("id")->onDelete('set null')->on("vestidos_countries");
            $table->string('zip_code');
            $table->string('phone_number_1');
            $table->string('phone_number_2');
            $table->string('email');
            $table->text('ip_address');
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
        Schema::dropIfExists('vestidos_user_address');
    }
}
