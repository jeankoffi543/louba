<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointEnrolementLienTypeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_enrolement_lien_type_document', function (Blueprint $table) {
            $table->id('id_point_enrolement_lien_type_document');
            $table->integer('id_point_enrolement');
            $table->integer('id_type_document');
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
        Schema::dropIfExists('point_enrolement_lien_type_document');
    }
}
