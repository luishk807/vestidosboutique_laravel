<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('products_name');
            $table->integer('products_img');
            $table->text('products_description');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('product_stock');
            $table->integer('product_closure_id');
            $table->string('product_detail');
            $table->integer('product_fabric_id');
            $table->integer('product_fit_id');
            $table->string('product_length');
            $table->integer('product_neckline_id');
            $table->integer('product_waistine_id');
            $table->integer('product_size');
            $table->decimal('product_total',10,2);
            $table->text('search_labels');
            $table->integer('vendor_id');
            $table->integer('status');
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
        Schema::dropIfExists('vestidos_products');
    }
}
