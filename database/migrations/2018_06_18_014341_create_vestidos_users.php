<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('password');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('gender');
            $table->text('ip');
            $table->integer('preferred_language');
            $table->integer('user_type')->unsigned()->nullable();
            $table->foreign("user_type")->references("id")->on("vestidos_user_types")->onDelete('set null');
            $table->integer('status')->unsigned()->nullable();
            $table->foreign("status")->references("id")->on("vestidos_status_users")->onDelete('set null');
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
        Schema::dropIfExists('vestidos_users');
    }
}
