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
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign("category_id")->references("id")->on("vestidos_categories")->onDelete('set null');
            $table->integer('product_type_id')->unsigned()->nullable();
            $table->foreign("product_type_id")->references("id")->on("vestidos_product_types")->onDelete('set null');
            $table->string('products_name')->nullable();
            $table->string('product_model')->nullable();
            $table->text('products_description')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign("brand_id")->references("id")->on("vestidos_brands")->onDelete('set null');
            $table->integer('product_closure_id')->unsigned()->nullable();
            $table->foreign("product_closure_id")->references("id")->on("vestidos_closure_types")->onDelete('set null');
            $table->string('product_detail')->nullable();
            $table->integer('product_fabric_id')->unsigned()->nullable();
            $table->foreign("product_fabric_id")->references("id")->on("vestidos_fabric_types")->onDelete('set null');
            $table->integer('product_length')->unsigned()->nullable();
            $table->foreign('product_length')->references('id')->on('vestidos_length_types')->onDelete("set null");
            $table->integer('product_neckline_id')->unsigned()->nullable();
            $table->foreign("product_neckline_id")->references("id")->on("vestidos_neckline_types")->onDelete('set null');
            $table->integer('style')->unsigned()->nullable();
            $table->foreign("style")->references("id")->on("vestidos_styles")->onDelete('set null');
            $table->boolean('is_new')->nullable();
            $table->date('purchase_date')->nullable();
            $table->text('search_labels')->nullable();
            $table->tinyInteger('top_dress')->nullable();
            $table->tinyInteger('top_quince')->nullable();
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->foreign("vendor_id")->references("id")->on("vestidos_vendors")->onDelete('set null');
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
        Schema::dropIfExists('vestidos_products');
    }
}
