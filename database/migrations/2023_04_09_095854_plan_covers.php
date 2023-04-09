<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlanCovers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_covers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')
            ->constrained('plans')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('cover_type')->nullable();
            $table->string('classification')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('in_use')->nullable();
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
        Schema::dropIfExists('plan_covers');
    }
}
