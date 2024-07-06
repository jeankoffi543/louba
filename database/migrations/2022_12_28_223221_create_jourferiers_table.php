<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourferiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jourferier', function (Blueprint $table) {
            $table->id('id_jfpe');
            $table->string('nom_jfpe')->nullable()->default(null);
            $table->string('date_jfpe')->nullable()->default(null);
            $table->integer('id_pe');
            $table->integer('id_user');
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
        Schema::dropIfExists('jourferier');
    }
}
