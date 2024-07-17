<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importation_document', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable()->default(null);
            $table->dateTime('date_register');
            $table->string('status')->nullable()->default(null);
            $table->string('message')->nullable()->default(null);
            $table->string('fichier')->nullable()->default(null);
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
        Schema::dropIfExists('importation_document');
    }
}
