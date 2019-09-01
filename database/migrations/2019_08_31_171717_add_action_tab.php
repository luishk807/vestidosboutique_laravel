<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionTab extends Migration
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
            $table->integer('action_tab')->after("action_link")->default(false)->nullable();
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
            $table->dropColumn('action_tab');
        });
    }
}
