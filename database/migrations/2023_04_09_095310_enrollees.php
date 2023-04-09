<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Enrollees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollees', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('surname');
            $table->string('first_name');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->foreignId('hcp_id')
             ->constrained('providers')
             ->onUpdate('cascade')
             ->onDelete('cascade');
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->date('dob')->nullable();
            $table->string('relationship')->nullable();
            $table->string('enrollee_category')->nullable();
            $table->string('plan');
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('suspended_date')->nullable();
            $table->text('suspension_reason')->nullable();
            $table->string('status')->nullable();

            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_id_number')->nullable();
            $table->string('designation')->nullable();

            $table->string('next_of_kin')->nullable();
            $table->string('nk_relationship')->nullable();
            $table->string('nk_phone')->nullable();
            $table->string('nk_email')->nullable();
            $table->text('nk_address')->nullable();

            $table->string('blood_group')->nullable();
            $table->string('genotype')->nullable();
            $table->boolean('have_diabetes')->nullable();
            $table->boolean('have_epilepsy')->nullable();
            $table->boolean('have_hypertension')->nullable();
            $table->boolean('have_sickle_cell')->nullable();
            $table->boolean('have_asthma')->nullable();
            $table->boolean('have_obesity')->nullable();
            $table->boolean('have_allegies')->nullable();
            $table->boolean('have_ulcer')->nullable();
            $table->boolean('have_mental')->nullable();
            $table->boolean('had_surgery')->nullable();
            $table->boolean('been_hospitalized')->nullable();
            $table->boolean('have_cancer')->nullable();
            $table->boolean('have_heart_issues')->nullable();
            $table->boolean('have_ecg')->nullable();
            $table->boolean('have_hiv')->nullable();
            $table->boolean('have_urinary_disease')->nullable();
            $table->boolean('have_blood_disease')->nullable();

            $table->string('password');

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
        Schema::dropIfExists('enrollees');
    }
}
