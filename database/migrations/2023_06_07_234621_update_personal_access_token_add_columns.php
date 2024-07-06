<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePersonalAccessTokenAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->bigInteger("tokenable_id")->nullable();
            $table->string("tokenable_type", 255)->nullable();
            $table->dropColumn("tokenable");
        });
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string("tokenable", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropColumn("tokenable_id");
            $table->dropColumn("tokenable_type");
            $table->dropColumn("tokenable");
        });

        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string("tokenable", 255);
        });
    }
}
