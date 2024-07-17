<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorPointEnrolementLienTypeDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('point_enrolement_lien_type_document');
        Schema::create('point_enrolement_lien_type_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_point_enrolement');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_point_enrolement')->references('id_pe')->on('point_enrolement');
            $table->foreign('id_product')->references('id')->on('products');
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
