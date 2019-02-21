<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsAddModifiedbyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vestidos_products', function (Blueprint $table) {
            $table->integer('modified_by')->unsigned()->nullable();
            $table->foreign("modified_by")->references("id")->on("vestidos_users")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vestidos_products', function (Blueprint $table) {
            $table->dropColumn('modified_by');
        });
    }
}
