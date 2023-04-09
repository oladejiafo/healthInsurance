<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('email')->unique();            
            $table->string('phone');
            $table->string('city');
            $table->string('country');
            $table->string('website')->nullable();
            $table->string('hmo_code')->nullable();
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
        Schema::dropIfExists('company_info');
    }
}
