<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldToServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service', function (Blueprint $table) {
            $table->dropColumn('id_type_document');
            $table->dropColumn('nom_type_document');
            $table->dropColumn('image_type_document');
            $table->dropColumn('description_type_document');
        });

        Schema::table('service', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('image', 255);
            $table->longText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service', function (Blueprint $table) {

            $table->renameColumn('id', 'id_type_document');
            $table->renameColumn('name', 'nom_type_document');
            $table->renameColumn('image', 'image_type_document');
            $table->renameColumn('description', 'description_type_document');
        });
    }
}
