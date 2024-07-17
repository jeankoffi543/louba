<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteDateMiseAJourToActualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actuality', function (Blueprint $table) {
            $table->dropColumn("date_mise_a_jour");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actuality', function (Blueprint $table) {
            $table->dateTime("date_mise_a_jour");
        });
    }
}
