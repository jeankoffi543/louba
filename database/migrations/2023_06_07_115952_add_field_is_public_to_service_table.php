<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIsPublicToServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service', function (Blueprint $table) {
            //
            $table->boolean('is_public')->nullable()->default(true);
            $table->boolean('is_disable')->nullable()->default(false);
        });

        Schema::table('type_document', function (Blueprint $table) {
            //
            $table->boolean('is_public')->nullable()->default(true);
            $table->boolean('is_disable')->nullable()->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service', function (Blueprint $table) {
            $table->dropColumn('is_public');
            $table->dropColumn('is_disable');
        });

        Schema::table('type_document', function (Blueprint $table) {
            $table->dropColumn('is_public');
            $table->dropColumn('is_disable');
        });
    }
}
