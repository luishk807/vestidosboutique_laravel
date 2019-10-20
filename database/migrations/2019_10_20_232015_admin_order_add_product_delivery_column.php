<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminOrderAddProductDeliveryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vestidos_orders', function (Blueprint $table) {
            //
            $table->integer("delivery_speed_id")->after("payment_type")->unsigned()->nullable();
            $table->foreign("delivery_speed_id")->references("id")->on("vestidos_product_deliveries")->onDelete('set null');
            $table->decimal("delivery_speed_cost")->after("payment_type")->nullable();
            $table->string("delivery_speed_name")->after("payment_type")->nullable();
            $table->text("delivery_speed_description")->after("payment_type")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('vestidos_orders', function (Blueprint $table) {
            //
            $table->dropColumn(["delivery_speed_id","delivery_speed_cost","delivery_speed_name","delivery_speed_description"]);
        });
    }
}
