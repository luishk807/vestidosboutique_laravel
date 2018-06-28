<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign("product_id")->references("id")->onDelete('cascade')->on("vestidos_products");
            $table->string('name');
            $table->string('color_code');
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
        Schema::dropIfExists('vestidos_colors');
    }
}
