<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('habilete_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habilete_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('habilete_id')->references('id')->on('habiletes')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilete_permission');
    }
};
