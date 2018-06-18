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
            $table->integer('category_id')->unsigned();
            $table->foreign("category_id")->references("id")->on("vestidos_category");
            $table->integer('brand_id')->unsigned();
            $table->foreign("brand_id")->references("id")->on("vestidos_brands");
            $table->integer('product_stock');
            $table->integer('product_closure_id')->unsigned();
            $table->foreign("product_closure_id")->references("id")->on("vestidos_closure_types");
            $table->string('product_detail');
            $table->integer('product_fabric_id')->unsigned();
            $table->foreign("product_fabric_id")->references("id")->on("vestidos_fabric_types");
            $table->integer('product_fit_id')->unsigned();
            $table->foreign("product_fit_id")->references("id")->on("vestidos_fit_type");
            $table->string('product_length');
            $table->integer('product_neckline_id')->unsigned();
            $table->foreign("product_neckline_id")->references("id")->on("vestidos_neckline_types");
            $table->integer('product_waistline_id')->unsigned();
            $table->foreign("product_waistline_id")->references("id")->on("vestidos_waistline_type");
            $table->integer('product_size');
            $table->decimal('product_total',10,2);
            $table->text('search_labels');
            $table->integer('vendor_id')->unsigned();
            $table->foreign("vendor_id")->references("id")->on("vestidos_vendors");
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
