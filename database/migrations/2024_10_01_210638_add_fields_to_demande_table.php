<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande', function (Blueprint $table) {
            //
            $table->string('numero_indentification_unique')->nullable();
            $table->string('father_nationality')->nullable();
            $table->string('mother_nationality')->nullable();
            $table->string('numero_pre_demande')->uniqid()->nullable();
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
            //
            Schema::dropColumns('demande', 'numero_indentification_unique', 'father_nationality', 'mother_nationality', 'numero_pre_demande');
        });
    }
};
