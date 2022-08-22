<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currents', function (Blueprint $table) {
            $table->id();

            $table->string("observation_time");
            $table->bigInteger("temperature");
            $table->bigInteger("weather_code");
            $table->string("weather_icons");
            $table->string("weather_descriptions");
            $table->bigInteger("wind_speed");
            $table->bigInteger("wind_degree");
            $table->string("wind_dir");
            $table->bigInteger("pressure");
            $table->bigInteger("precip");
            $table->bigInteger("humidity");
            $table->bigInteger("cloudcover");
            $table->bigInteger("feelslike");
            $table->bigInteger("uv_index");
            $table->bigInteger("visibility");
            $table->string("is_day");

            $table->timestamps();
        });
    }

/*

    "current": {
        "observation_time": "03:04 PM",
        "temperature": 27,
        "weather_code": 116,
        "weather_icons": [
            "https://assets.weatherstack.com/images/wsymbols01_png_64/wsymbol_0002_sunny_intervals.png"
        ],
        "weather_descriptions": [
            "Partly cloudy"
        ],
        "wind_speed": 7,
        "wind_degree": 320,
        "wind_dir": "NW",
        "pressure": 1018,
        "precip": 0,
        "humidity": 44,
        "cloudcover": 25,
        "feelslike": 27,
        "uv_index": 7,
        "visibility": 16,
        "is_day": "yes"
    }
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currents');
    }
};
