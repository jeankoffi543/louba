<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RedefineSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn('paragraphe1');
            $table->dropColumn('paragraphe2');
            $table->dropColumn('imagebg');
            $table->dropColumn('boutton');
            $table->dropColumn('couleur');
        });
        Schema::table('slider', function (Blueprint $table) {
            $table->longText('description');
            $table->longText('full_description');
            $table->string('image_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->longText('paragraphe1');
            $table->longText('paragraphe2');
            $table->string('imagebg');
            $table->string('boutton');
            $table->string('couleur');
        });
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('full_description');
            $table->dropColumn('image_bg');
        });
    }
}
