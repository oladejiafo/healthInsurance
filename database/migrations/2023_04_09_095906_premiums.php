<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Premiums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premiums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')
            ->constrained('claims')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('enrollee_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('prescription_id')->nullable();

            $table->date('date')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('dose')->nullable();
            $table->bigInteger('duration')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('tariff_amount')->nullable();
            $table->decimal('paid_amount')->nullable();
            $table->string('vetting_criteria')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('premiums');
    }
}
