<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VestidosProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('=products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer("status");
            $table->integer("category_id")->unsigned();
            $table->foreign("category_id")->references("id")->on("vestidos_category");
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
        Schema::dropIfExists('=products');
    }
}
