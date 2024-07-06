<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenuSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenu_site', function (Blueprint $table) {
            $table->id();
            $table->string('tagdur')->nullable()->default(null);
            $table->string('titre')->nullable()->default(null);
            $table->text('paragraphe1')->nullable()->default(null);
            $table->text('paragraphe2')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->dateTime('date_mise_a_jour')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
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
        Schema::dropIfExists('contenu_site');
    }
}
