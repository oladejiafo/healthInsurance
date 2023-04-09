<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Investigations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('claim_id')
            ->constrained('claims')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('enrollee_code')->nullable();
            $table->string('provider_code')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('tariff_amount')->nullable();
            $table->decimal('paid_amount')->nullable();
            $table->text('criteria')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('investigations');
    }
}
