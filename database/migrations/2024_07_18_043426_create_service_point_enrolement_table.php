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
        Schema::create('service_point_enrolement', function (Blueprint $table) {
            // pivot table of service and point_enrolement
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('point_enrolement_id')->nullable();
            
            $table->foreign('service_id')->references('id')->on('service')->onDelete('cascade');
            $table->foreign('point_enrolement_id')->references('id_pe')->on('point_enrolement')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('service', 'prix', 'form_type');
    }
};
