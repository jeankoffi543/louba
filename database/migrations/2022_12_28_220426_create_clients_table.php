<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id('id_client');
            $table->string('nom_client')->nullable()->default(null);
            $table->string('prenom_client')->nullable()->default(null);
            $table->string('telephone_client')->nullable()->default(null);
            $table->string('email_client')->nullable()->default(null);
            $table->string('adresse_client')->nullable()->default(null);
            $table->dateTime('date_creation_client')->nullable()->default(null);
            $table->string('genre_client')->nullable()->default(null);
            $table->string('date_naissance_client')->nullable()->default(null);
            $table->string('code_oni')->nullable()->default(null);
            $table->string('password_client')->nullable()->default(null);
            $table->integer('actif_client')->nullable()->default(null);
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
        Schema::dropIfExists('client');
    }
}
