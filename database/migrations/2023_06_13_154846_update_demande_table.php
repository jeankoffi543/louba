<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDemandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande', function (Blueprint $table) {
            $table->dropColumn('id_type_document');
            $table->dropColumn(['id_type_service']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demande', function (Blueprint $table) {

            $table->integer('id_type_document');
            $table->integer('id_type_service');

        });
    }
}
