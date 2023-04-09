<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Plans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string('plan_name')->nullable();
            $table->decimal('plan_cap_rate')->nullable();
            $table->decimal('plan_individual_premium')->nullable();
            $table->decimal('plan_family_premium')->nullable();
            $table->decimal('plan_max_benefit')->nullable();
            $table->boolean('plan_is_active')->nullable();
            $table->integer('plan_dependant_capacity')->nullable();
            $table->decimal('plan_covered_amount')->nullable();
            $table->string('provider')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
