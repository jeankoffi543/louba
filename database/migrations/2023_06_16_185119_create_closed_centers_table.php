<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosedCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closed_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_point_enrolement');
            $table->dateTime('closed_date');
            $table->string('raison', 50);
            $table->longText('description', 255)->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('closed_centers');
    }
}
