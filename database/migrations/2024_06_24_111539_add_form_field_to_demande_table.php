<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormFieldToDemandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande', function (Blueprint $table) {
            $table->string('demand_type')->enum(['first', 'renew', 'duplicata'])->nullable();
            $table->string('passport_type')->enum(['ordinary', 'diploma', 'service'])->nullable();
            $table->string('recepice_number')->nullable();
            $table->dateTime('paiement_date')->nullable();
            $table->integer('personal_number')->nullable();
            // $table->string('first_name')->nullable();
            // $table->string('last_name')->nullable();
            // $table->date('date_of_birth')->nullable();
            $table->string('birth_address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nationality_state')->enum(['birth', 'naturalization', 'mariage'])->nullable();
            $table->string('profession')->nullable();
            $table->string('address')->nullable();
            $table->string('marital_status')->enum(['married', 'single', 'divorced', 'widower'])->nullable();
            $table->integer('height')->nullable();
            $table->string('complexion')->nullable();
            $table->string('particular_sign')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('skin_color')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('father_last_name')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_last_name')->nullable();
            // $table->string('email')->nullable();
            // $table->string('phone')->nullable();
            $table->string('cni')->nullable();
            // $table->string('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande');
    }
}
