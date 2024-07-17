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
        // if predemande_step is 1 pre demande not accept yet, else if predemande_step is 2 pre demande accept, else predemande_step is 3 pre demande done
        Schema::table('demande', function (Blueprint $table) {
            $table->integer('predemande_step')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('demande', 'predemande_step');
    }
};
