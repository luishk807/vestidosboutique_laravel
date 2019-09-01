<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLingleLineAlerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vestidos_alerts', function (Blueprint $table) {
            //
            $table->integer('line_single')->after("line_2")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vestidos_alerts', function (Blueprint $table) {
            //
            $table->dropColumn('line_single');
        });
    }
}
