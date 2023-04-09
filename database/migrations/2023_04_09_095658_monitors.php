<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Monitors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();

            $table->string('user_category')->nullable();
            $table->string('user_name')->nullable();
            $table->date('login_date')->nullable();
            $table->text('file_used')->nullable();
            $table->text('details')->nullable();
            $table->time('login_time')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('company')->nullable();
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
        Schema::dropIfExists('monitors');
    }
}
