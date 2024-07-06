<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTablePointEnrolementLienTypeDocument extends Migration
{

    public function up()
    {
        Schema::rename('point_enrolement_lien_type_document', 'point_enrolement_products');
    }

    public function down()
    {
        Schema::rename('point_enrolement_products', 'point_enrolement_lien_type_document');
    }
}
