<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tarrif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarrif', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('name')->nullable();
            $table->string('sub_category')->nullable();
            $table->decimal('price')->nullable();
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
        Schema::dropDatabaseIfExists('tarrif');
    }
}
