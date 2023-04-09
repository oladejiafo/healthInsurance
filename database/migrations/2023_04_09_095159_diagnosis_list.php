<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiagnosisList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')
             ->constrained('claims')
             ->onUpdate('cascade')
             ->onDelete('cascade');
            $table->string('enrollee_code');
            $table->string('provider_code');            
            $table->string('diagnosis');
            $table->date('date');

            $table->string('created_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('diagnosis_list');
    }
}
