<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('tagdur')->nullable()->default(null);
            $table->string('titre')->nullable()->default(null);
            $table->text('paragraphe1')->nullable()->default(null);
            $table->text('paragraphe2')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->string('imagebg')->nullable()->default(null);
            $table->string('boutton')->nullable()->default(null);
            $table->string('couleur')->nullable()->default(null);
            $table->dateTime('date_mise_a_jour')->nullable()->default(null);
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
        Schema::dropIfExists('slider');
    }
}
