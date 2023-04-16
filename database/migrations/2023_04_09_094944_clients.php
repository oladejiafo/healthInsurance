<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique(); 
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();           
            $table->string('status')->nullable();
            $table->date('date_joined')->nullable();
            $table->date('date_exited')->nullable();
            $table->date('date_suspended')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
