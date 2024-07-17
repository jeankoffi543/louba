<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande', function (Blueprint $table) {
            $table->id('id_demande');
            $table->integer('id_point_enrolement');
            $table->integer('id_client');
            $table->dateTime('date_enregistrement_demande')->nullable()->default(null);
            $table->string('date_rdv_demande')->nullable()->default(null);
            $table->string('date_traitement_demande')->nullable()->default(null);
            $table->integer('status_demande')->nullable()->default(null);
            $table->string('raison_status_demande')->nullable()->default(null);
            $table->integer('montant_demande')->nullable()->default(null);
            $table->integer('id_type_document');
            $table->string('url_piece_fournie_demande')->nullable()->default(null);
            $table->string('code_demande')->nullable()->default(null);
            $table->string('type_service')->nullable()->default(null);
            $table->string('document1_demande')->nullable()->default(null); 
            $table->string('document2_demande')->nullable()->default(null);
            $table->string('nom_asker')->nullable()->default(null);
            $table->string('prenom_asker')->nullable()->default(null);
            $table->string('email_asker')->nullable()->default(null);
            $table->string('genre_asker')->nullable()->default(null);
            $table->string('telephone_asker')->nullable()->default(null);
            $table->string('date_naissance_asker')->nullable()->default(null);
            $table->string('adresse_asker')->nullable()->default(null);
            $table->string('date_production')->nullable()->default(null);
            $table->integer('production_disponible')->nullable()->default(null);
            $table->integer('recuperation')->nullable()->default(null);
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
        Schema::dropIfExists('demande');
    }
}
