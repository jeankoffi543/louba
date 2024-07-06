<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToActualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actuality', function (Blueprint $table) {

            $table->dropColumn("boutton");
            $table->dropColumn('couleur');
        });
        Schema::table('actuality', function (Blueprint $table) {
            $table->string('author')->nullable()->default('UNKNOW');
            $table->string('source')->nullable();
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

            $table->string("boutton");
            $table->string('couleur');
        });
        Schema::table('actuality', function (Blueprint $table) {

            $table->dropColumn('author');
            $table->dropColumn('source');
        });
    }
}
