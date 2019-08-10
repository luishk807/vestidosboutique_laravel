<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProvinceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vestidos_corregimientos', function($table) {
            $table->integer('province_id')->after('id')->unsigned()->nullable();
            $table->foreign("province_id")->references("id")->on("vestidos_provinces")->onDelete('set null');
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
        Schema::table('vestidos_corregimientos', function($table) {
            $table->dropColumn('province_id');
        });
    }
}
