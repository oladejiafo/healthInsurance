<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Complaints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
             ->constrained('clients')
             ->onUpdate('cascade');
            $table->foreignId('enrollee_id')
             ->nullable()
             ->constrained('clients')
             ->onUpdate('cascade');
            $table->text('complaint')->nullable();
            $table->text('action')->nullable();  
            $table->string('status')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('complaints');
    }
}
