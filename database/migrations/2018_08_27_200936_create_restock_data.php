<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestockData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_products_restocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("product_id")->unsigned();
            $table->foreign("product_id")->references("id")->on("vestidos_products")->onDelete("cascade");
            $table->integer("vendor_id")->unsigned()->nullable();
            $table->foreign("vendor_id")->references("id")->on("vestidos_vendors")->onDelete("set null");
            $table->integer('color')->unsigned()->nullable();
            $table->foreign("color")->references("id")->on("vestidos_colors")->onDelete('cascade');
            $table->integer('size')->unsigned()->nullable();
            $table->foreign("size")->references("id")->on("vestidos_sizes")->onDelete('cascade');
            $table->integer("quantity");
            $table->date("restock_date");
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
        Schema::dropIfExists('vestidos_products_restocks');
    }
}
