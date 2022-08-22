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
        Schema::create('model_climates', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('query');
            $table->string('language');
            $table->string('unit');

            $table->unsignedBigInteger('location_id')->nullable();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

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
        Schema::dropIfExists('model_climates');
    }
};
