<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosOrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_orders_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign("order_id")->references("id")->on("vestidos_orders")->onDelete('cascade');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign("product_id")->references("id")->on("vestidos_products")->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total')->nullable();
            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign("color_id")->references("id")->on("vestidos_colors")->onDelete('set null');
            $table->integer('size_id')->unsigned()->nullable();
            $table->foreign("size_id")->references("id")->on("vestidos_sizes")->onDelete('set null');
            $table->integer('status')->unsigned()->default(1)->nullable();
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
        Schema::dropIfExists('vestidos_orders_products');
    }
}
