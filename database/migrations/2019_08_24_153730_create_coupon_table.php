<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_coupons', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('code')->unique();
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->float('discount')->nullable();
            $table->date("exp_date")->nullable();
            $table->integer('status')->default(1)->unsigned()->nullable();
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
        Schema::dropIfExists('vestidos_coupons');
    }
}
