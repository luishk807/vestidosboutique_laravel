<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTable extends Migration
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
            $table->string('shipping_province')->nullable()->after("shipping_city");
            $table->string('billing_province')->nullable()->after("billing_city");
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
            $table->dropColumn('shipping_province');
            $table->dropColumn('billing_province');
        });
    }
}
