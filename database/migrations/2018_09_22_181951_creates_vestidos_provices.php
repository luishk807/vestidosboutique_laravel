<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesVestidosProvices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("country_id")->unsigned();
            $table->foreign("country_id")->references("id")->on("vestidos_countries")->onDelete("cascade");
            $table->string("name");
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
        Schema::dropIfExists('vestidos_provinces');
    }
}
