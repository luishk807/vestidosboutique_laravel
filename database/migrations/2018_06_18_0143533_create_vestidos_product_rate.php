<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosProductRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_product_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign("user_id")->references("id")->onDelete('set null')->on("vestidos_users");
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign("product_id")->references("id")->onDelete('cascade')->on("vestidos_products");
            $table->text('user_comment');
            $table->integer('user_rate');
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
        Schema::dropIfExists('vestidos_product_rates');
    }
}
