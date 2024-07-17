<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_document', function (Blueprint $table) {
            $table->id('id_type_document');
            $table->string('nom_type_document')->nullable()->default(null);
            $table->string('document_a_fournir_type_document')->nullable()->default(null);
            $table->integer('id_point_enrolement_lien_type_document');
            $table->dateTime('date_enregistrement_type_document')->nullable()->default(null);
            $table->string('image_type_document')->nullable()->default(null);
            $table->text('description_type_document')->nullable()->default(null);
            $table->integer('prix')->nullable()->default(null);
            $table->integer('activation_type_document')->nullable()->default(null);
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
        Schema::dropIfExists('type_document');
    }
}
