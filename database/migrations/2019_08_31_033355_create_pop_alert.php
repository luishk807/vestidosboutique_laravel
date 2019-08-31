<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopAlert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_alerts', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string("title");
            $table->text("line_1");
            $table->text("line_2");
            $table->string("action_text");
            $table->text("action_link");
            $table->integer('status')->unsigned()->default(1)->nullable();
            $table->foreign("status")->references("id")->on("vestidos_statuses")->onDelete('set null');
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
        Schema::dropIfExists('vestidos_alerts');
    }
}
