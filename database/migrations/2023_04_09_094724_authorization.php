<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Authorization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')
             ->constrained('providers');
            $table->foreignId('enrollee_id')
             ->constrained('enrollees');
            $table->bigInteger('claim_id')->nullable();
            $table->string('disease_type')->nullable();
            $table->string('issuer_name')->nullable();
            $table->string('issuer_phone')->nullable();
            $table->string('authorized_by')->nullable();
            $table->date('request_date')->nullable();
            $table->time('request_time')->nullable();
            $table->date('issued_date')->nullable();
            $table->time('issued_time')->nullable();
            $table->string('authorization_code')->nullable();
            $table->decimal('service_cost')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status')->nullable(); 
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
        Schema::dropIfExists('authorization');
    }
}
