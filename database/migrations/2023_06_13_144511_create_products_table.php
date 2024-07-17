<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('type_document');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->integer('prix')->nullable()->default(null);
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_disable')->nullable()->default(true);
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
        Schema::dropIfExists('products');
    }
}
