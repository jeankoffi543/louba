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
        Schema::create('traitements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habilete_id');
            $table->unsignedBigInteger('id_demande');
            $table->string('action');
            $table->timestamps();

            $table->foreign('habilete_id')->references('id')->on('habiletes');
            $table->foreign('id_demande')->references('id')->on('demande');
        });
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traitements');
    }
};
