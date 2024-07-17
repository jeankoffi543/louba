<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldInActualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actuality', function (Blueprint $table) {
            $table->dropColumn('paragraphe1');
            $table->dropColumn('paragraphe2');
        });
        Schema::table('actuality', function (Blueprint $table) {
            $table->date('date_of_publish')->nullable();
            $table->longText('description');
            $table->longText('full_description');
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
            $table->longText('paragraphe1');
            $table->longText('paragraphe2');
        });
        Schema::table('actuality', function (Blueprint $table) {
            $table->dropColumn('date_of_publish');
            $table->dropColumn('description');
            $table->dropColumn('full_description');
        });
    }
}
