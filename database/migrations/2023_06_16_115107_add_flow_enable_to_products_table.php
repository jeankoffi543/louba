<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlowEnableToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("is_disable");

        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean("flow_enable")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean("is_disable")->default(true);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("flow_enable");
        });
    }
}
