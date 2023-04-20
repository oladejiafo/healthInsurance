<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agelimit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agelimit', function (Blueprint $table) {
            $table->id();
            $table->integer('age_limit');
            $table->string('applicable_relationship')->nullable();
            $table->foreignId('provider_id'); 
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
        Schema::dropIfExists('agelimit');
    }
}
