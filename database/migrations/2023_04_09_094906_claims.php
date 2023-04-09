<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Claims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('hcp_code')->nullable();
            $table->string('hcp_name')->nullable();
            $table->string('enrollee_code')->nullable();
            $table->string('enrollee_name')->nullable();
            $table->string('enrollee_phone')->nullable();
            $table->text('enrollee_address')->nullable();
            $table->date('pay_date')->nullable();
            $table->string('authorization_code')->nullable();
            
            $table->decimal('claim_amount')->nullable();
            $table->decimal('paid_amount')->nullable();
            $table->decimal('deduction_amount')->nullable();
            $table->text('deduction_reason')->nullable();
            $table->string('status')->nullable();

            $table->text('diagnosis')->nullable();
            $table->text('diagnosis1')->nullable();
            $table->text('diagnosis3')->nullable();
            $table->text('diagnosis4')->nullable();
            $table->text('treatment')->nullable();
            $table->text('words')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('location')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('company')->nullable();
            $table->date('requested_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->date('claim_date')->nullable();
            $table->date('attendance_date')->nullable();
            $table->date('admission_date')->nullable();
            $table->date('discharge_date')->nullable();
            $table->date('entry_date')->nullable();
            $table->text('remarks')->nullable();
            $table->string('creatd_by')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
