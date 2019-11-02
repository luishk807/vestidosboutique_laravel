<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosDeliveryProductTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_product_deliveries', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string("name");
            $table->text("description");
            $table->decimal('total')->nullable();
            $table->boolean("main")->default(false)->nullable();
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
        Schema::dropIfExists('vestidos_product_deliveries');
    }
}
