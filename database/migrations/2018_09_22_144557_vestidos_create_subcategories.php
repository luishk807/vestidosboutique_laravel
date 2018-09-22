<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VestidosCreateSubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("category_id")->unsigned();
            $table->foreign("category_id")->references("id")->on('vestidos_categories')->onDelete('cascade');
            $table->string("name");
            $table->integer("status")->default(1)->unsigned()->nullable();
            $table->foreign("status")->references("id")->on("vestidos_statuses")->onDelete("set null");
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
        Schema::dropIfExists('vestidos_sub_categories');
    }
}
