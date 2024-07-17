<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement', function (Blueprint $table) {
            $table->id('id_pay');
            $table->integer('amount_pay');
            $table->string('reference_pay')->nullable()->default(null);
            $table->string('date_pay')->nullable()->default(null);
            $table->integer('id_client');
            $table->integer('id_demande');
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
        Schema::dropIfExists('paiement');
    }
}
