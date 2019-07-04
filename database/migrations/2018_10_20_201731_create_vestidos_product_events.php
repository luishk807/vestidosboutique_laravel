<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosProductEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_product_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->default(1)->nullable();
            $table->foreign("product_id")->references("id")->on("vestidos_products")->onDelete('cascade');
            $table->integer('event_id')->unsigned()->default(1)->nullable();
            $table->foreign("event_id")->references("id")->on("vestidos_events")->onDelete('cascade');
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
        Schema::dropIfExists('vestidos_product_events');
    }
}
