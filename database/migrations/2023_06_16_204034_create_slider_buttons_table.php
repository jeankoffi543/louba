<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_buttons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->foreign('slider_id')->references('id')->on('slider');
            $table->string('button_color')->nullable();
            $table->string('button_background_color')->nullable();
            $table->string('button_text_color')->nullable();  
            $table->boolean('have_external_link')->nullable()->default(false);  
            $table->string('redirect_to')->nullable();
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
        Schema::dropIfExists('slider_buttons');
    }
}
