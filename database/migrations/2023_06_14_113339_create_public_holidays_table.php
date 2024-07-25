<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('jourferier');
        Schema::create('public_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date');
            $table->unsignedBigInteger('id_point_enrolement')->nullable();
            $table->foreign('id_point_enrolement')->references('id_pe')->on('point_enrolement');
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
        Schema::dropIfExists('public_holidays');
    }
}
