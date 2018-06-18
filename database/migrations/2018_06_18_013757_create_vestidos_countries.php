<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestidosCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestidos_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->char('countryCode',2);
            $table->string('countryName');
            $table->char('currencyCode',3);
            $table->char('fipsCode',2);
            $table->char('isoNumeric',4);
            $table->string('north');
            $table->string('south');
            $table->string('east');
            $table->string('west');
            $table->string('capital');
            $table->string('continentName');
            $table->char('continent',2);
            $table->string('languages');
            $table->char('isoAlpha3',3);
            $table->integer('geonameId');
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
        Schema::dropIfExists('vestidos_countries');
    }
}
