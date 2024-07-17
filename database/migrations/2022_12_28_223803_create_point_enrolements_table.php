<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointEnrolementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_enrolement', function (Blueprint $table) {
            $table->id('id_pe');
            $table->string('nom_pe')->nullable()->default(null);
            $table->integer('capacite_maximale_jour_pe')->nullable()->default(null);
            $table->string('id_creation_pe')->nullable()->default(null);
            $table->string('longitude_pe')->nullable()->default(null);
            $table->string('latitude_pe')->nullable()->default(null);
            $table->string('telephone_pe')->nullable()->default(null);
            $table->string('email_pe')->nullable()->default(null);
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
        Schema::dropIfExists('point_enrolement');
    }
}
