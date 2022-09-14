<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_systems', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->boolean('status')->default('1');
            $table->enum('type', ['eir', 'expiry', 'insurances', 'other'])->default('other');

            $table->foreignIdFor(\App\Models\Country::class);
            $table->foreignIdFor(\App\Models\City::class);
            $table->foreignIdFor(\App\Models\User::class);
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
        Schema::dropIfExists('email_systems');
    }
}
