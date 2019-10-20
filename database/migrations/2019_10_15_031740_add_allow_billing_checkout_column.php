<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowBillingCheckoutColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vestidos_main_configs', function (Blueprint $table) {
            //
            $table->boolean("allow_billing")->after("id")->default(true)->nullable();
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
        Schema::table('vestidos_main_configs', function (Blueprint $table) {
            //
            $table->dropColumn('allow_billing');
        });
    }
}
