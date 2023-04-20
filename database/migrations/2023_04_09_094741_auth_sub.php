<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuthSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_sub', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('auth_id');
            $table->string('type')->nullable();
            $table->string('provider')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('unit_cost')->nullable();
            $table->decimal('total_cost')->nullable();
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
        Schema::dropIfExists('auth_sub');
    }
}
