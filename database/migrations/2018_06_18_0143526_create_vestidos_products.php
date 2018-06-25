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
            $table->text('products_description')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign("category_id")->references("id")->onDelete('set null')->on("vestidos_categories");
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign("brand_id")->references("id")->onDelete('set null')->on("vestidos_brands");
            $table->integer('product_stock')->nullable();
            $table->integer('product_closure_id')->unsigned()->nullable();
            $table->foreign("product_closure_id")->references("id")->onDelete('set null')->on("vestidos_closure_types");
            $table->string('product_detail')->nullable();
            $table->integer('product_fabric_id')->unsigned()->nullable();
            $table->foreign("product_fabric_id")->references("id")->onDelete('set null')->on("vestidos_fabric_types");
            $table->integer('product_fit_id')->unsigned()->nullable();
            $table->foreign("product_fit_id")->references("id")->onDelete('set null')->on("vestidos_fit_types");
            $table->string('product_length')->nullable();
            $table->integer('product_neckline_id')->unsigned()->nullable();
            $table->foreign("product_neckline_id")->references("id")->onDelete('set null')->on("vestidos_neckline_types");
            $table->integer('product_waistline_id')->unsigned()->nullable();
            $table->foreign("product_waistline_id")->references("id")->onDelete('set null')->on("vestidos_waistline_types");
            $table->integer('product_size')->nullable();
            $table->decimal('product_total',10,2);
            $table->text('search_labels')->nullable();
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->foreign("vendor_id")->references("id")->onDelete('set null')->on("vestidos_vendors");
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
        Schema::dropIfExists('vestidos_products');
    }
}
