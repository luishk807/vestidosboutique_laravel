<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVestidosUserAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vestidos_user_addresses', function (Blueprint $table) {
            $table->integer('province')->unsigned()->nullable();
            $table->foreign("province")->references("id")->on("vestidos_provinces");
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
        Schema::table('vestidos_user_addresses', function (Blueprint $table) {
            $table->dropColumn('province');
        });
    }
}
