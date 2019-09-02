<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlertId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vestidos_main_configs', function (Blueprint $table) {
            //
            $table->integer('alert_id')->after("allow_credit_card")->unsigned()->nullable();
            $table->foreign("alert_id")->references("id")->on("vestidos_alerts")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vestidos_main_configs', function (Blueprint $table) {
            //
            $table->dropColumn('coupon_id');
        });
    }
}
