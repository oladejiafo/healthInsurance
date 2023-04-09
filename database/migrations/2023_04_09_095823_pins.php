<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin', function (Blueprint $table) {
            $table->id();

            $table->string('pin')->nullable();
            $table->string('plan')->nullable();
            $table->boolean('is_used')->nullable();
            $table->string('used_by')->nullable();
            $table->date('used_date')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('pin');
    }
}
