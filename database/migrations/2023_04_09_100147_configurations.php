<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Configurations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('coy_name')->nullable();
            $table->string('coy_alias')->nullable();
            $table->string('coy_email')->unique();
            $table->string('portal_url')->nullable();
            $table->string('sms_email')->nullable()->unique();
            $table->string('sms_sub_account')->nullable();
            $table->string('sms_sub_password')->nullable();
            $table->string('sms_sender')->nullable();
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
        Schema::dropIfExists('configurations');
    }
};
