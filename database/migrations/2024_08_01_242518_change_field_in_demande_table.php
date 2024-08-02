<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande', function (Blueprint $table) {
            // Ajouter la colonne avec le nouveau type
            $table->longText('document_url')->nullable();
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
            // Supprimer la colonne si elle existe
            if (Schema::hasColumn('demande', 'document_url')) {
                $table->dropColumn('document_url');
            }
        });
    }
};
