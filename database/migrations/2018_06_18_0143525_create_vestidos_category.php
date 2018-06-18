<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('dress_type_id')->unsigned();
            $table->foreign('dress_type_id')->references("id")->on("vestidos_dress_types");
            $table->integer('dress_style_id')->unsigned();
            $table->foreign("dress_style_id")->references("id")->on("vestidos_styles");
            $table->integer('status')->unsigned();
            $table->foreign("status")->references("id")->on("vestidos_statuses");
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
        Schema::dropIfExists('vestidos_categories');
    }
}
