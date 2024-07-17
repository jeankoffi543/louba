<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteActualiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('actualite');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('actualite', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable()->default(null);
            $table->text('texte')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->dateTime('date_register')->nullable()->default(null);
            $table->timestamps();
        });
    }
}
