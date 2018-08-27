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
            $table->string('product_model')->nullable();
            $table->text('products_description')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign("brand_id")->references("id")->on("vestidos_brands")->onDelete('set null');
            $table->integer('product_stock')->nullable();
            $table->integer('product_closure_id')->unsigned()->nullable();
            $table->foreign("product_closure_id")->references("id")->on("vestidos_closure_types")->onDelete('set null');
            $table->string('product_detail')->nullable();
            $table->integer('product_fabric_id')->unsigned()->nullable();
            $table->foreign("product_fabric_id")->references("id")->on("vestidos_fabric_types")->onDelete('set null');
            $table->integer('product_fit_id')->unsigned()->nullable();
            $table->foreign("product_fit_id")->references("id")->on("vestidos_fit_types")->onDelete('set null');
            $table->string('product_length')->nullable();
            $table->integer('product_neckline_id')->unsigned()->nullable();
            $table->foreign("product_neckline_id")->references("id")->on("vestidos_neckline_types")->onDelete('set null');
            $table->integer('product_waistline_id')->unsigned()->nullable();
            $table->foreign("product_waistline_id")->references("id")->on("vestidos_waistline_types")->onDelete('set null');
            $table->decimal('total_sell',10,2)->nullable();
            $table->decimal('total_sell_old',10,2)->nullable();
            $table->boolean('is_sell')->default(false)->nullable();
            $table->decimal('total_rent',10,2)->nullable();
            $table->decimal('total_rent_old',10,2)->nullable();
            $table->boolean('is_rent')->default(true)->nullable();
            $table->boolean('is_new')->nullable();
            $table->date('purchase_date')->nullable();
            $table->text('search_labels')->nullable();
            $table->boolean('top_dress')->nullable();
            $table->boolean('top_quince')->nullable();
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
