<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateDemandeTable extends Migration
{

    public $tableName = 'demande';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop($this->tableName);

        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_point_enrolement');
            $table->unsignedBigInteger('id_sender');
            $table->unsignedBigInteger('id_client');
            $table->dateTime('date_rdv_demande');
            $table->dateTime('date_traitement_demande')->nullable()->default(null);
            $table->enum('status_demande', ["NEW", "REJECTED", "PENDING_PAY", "CLOSED"])->default("NEW");
            $table->string('raison_status')->nullable()->default(null);
            $table->string('type_request')->nullable()->default(null);
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_service');
            $table->string('document_url');
            $table->string('avatar_url');
            $table->string('code_demande')->nullable()->default(null);
            $table->foreign('id_point_enrolement')->references('id_pe')->on('point_enrolement');
            $table->foreign('id_client')->references('id')->on('client');
            $table->foreign('id_sender')->references('id')->on('client');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_service')->references('id')->on('service');
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
        Schema::dropIfExists($this->tableName);
    }
}
