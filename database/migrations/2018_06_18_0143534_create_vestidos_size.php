<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('vestidos_colors')->onDelete('cascade');
            $table->string('name');
            $table->decimal('total_sale',10,2)->nullable();
            $table->decimal('total_sale_old',10,2)->nullable();
            $table->boolean('is_sell')->default(false)->nullable();
            $table->decimal('total_rent',10,2)->nullable();
            $table->decimal('total_rent_old',10,2)->nullable();
            $table->boolean('is_rent')->default(true)->nullable();
            $table->integer('stock')->nullable();
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
        Schema::dropIfExists('vestidos_sizes');
    }
}
