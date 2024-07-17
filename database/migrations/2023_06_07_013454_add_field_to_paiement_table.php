<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToPaiementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->string("cpm_currency", 4)->nullable();
            $table->string("payment_method", 25)->nullable();
            $table->string("cel_phone_num", 225)->nullable();
            $table->string("cpm_phone_prefixe", 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement');
    }
}
