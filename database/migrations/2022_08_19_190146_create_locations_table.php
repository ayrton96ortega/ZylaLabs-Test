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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('country');
            $table->string('region');
            $table->string('lat');
            $table->string('lon');
            $table->string('timezone_id');
            $table->string('localtime');
            $table->bigInteger('localtime_epoch');
            $table->string('utc_offset');

//---------------ASIGNACION PARA RELACIONES POLIMORFICAS-------------------------
            $table->morphs('locationable');

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
        Schema::dropIfExists('locations');
    }
};
