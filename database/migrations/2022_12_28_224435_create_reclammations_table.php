<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclammationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclammation', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prenom')->nullable()->default(null);
            $table->text('sujet')->nullable()->default(null);
            $table->text('message')->nullable()->default(null);
            $table->string('telephone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('traiter')->nullable()->default(null);
            $table->dateTime('date')->nullable()->default(null);
            $table->dateTime('date_register')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('date_traitement')->nullable()->default(null);
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
        Schema::dropIfExists('reclammation');
    }
}
