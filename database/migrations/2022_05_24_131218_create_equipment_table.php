<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Country::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\City::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Spec::class)->onDelete('cascade');
            
            $table->string('year_of_manufacture')->nullable();
            $table->string('rental_cost_basis')->default(0);

            $table->string('driver_salary')->nullable();
            $table->string('rental_basis')->nullable();

            $table->string('make');
            $table->string('name');
            $table->string('type');

            $table->string('plate_no')->nullable();
            $table->string('chasis_no')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('model')->nullable();
            
            $table->text('owner_ship');
            $table->text('operator');

            $table->text('responsible_person')->nullable();
            $table->json('project_allocated_to')->nullable();
            $table->text('allocated_to')->nullable();
            $table->text('email')->nullable();

            $table->dateTime('registration_expiry')->nullable();

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
        Schema::dropIfExists('equipment');
    }
}
