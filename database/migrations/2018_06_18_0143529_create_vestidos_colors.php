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
            $table->integer('product_id')->unsigned();
            $table->foreign("product_id")->references("id")->on("vestidos_products")->onDelete('cascade');
            $table->string('name');
            $table->string('color_code');
            $table->integer('status')->default(1)->unsigned()->nullable();
            $table->foreign("status")->references("id")->on("vestidos_statuses")->onDelete('set null');
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
