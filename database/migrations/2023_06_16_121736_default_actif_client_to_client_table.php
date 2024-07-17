<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefaultActifClientToClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn('actif_client');
        });
        Schema::table('client', function (Blueprint $table) {
            $table->boolean('actif_client')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn('actif_client');
        });
        Schema::table('client', function (Blueprint $table) {
            $table->boolean('actif_client')->nullable()->default(null);
        });
    }
}
