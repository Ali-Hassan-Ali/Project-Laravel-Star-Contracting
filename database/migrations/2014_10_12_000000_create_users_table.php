<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('f_name', 100);
            $table->char('l_name', 100);
            $table->string('phone')->unique();
            $table->string('Email')->unique();
            $table->timestamp('Phone_verified_at')->nullable();
            $table->timestamp('Email_verified_at')->nullable();
            $table->integer('OTP')->default(-1);
            $table->string('password');
            $table->string('image')->default('sefhopwerwefoiweb');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
