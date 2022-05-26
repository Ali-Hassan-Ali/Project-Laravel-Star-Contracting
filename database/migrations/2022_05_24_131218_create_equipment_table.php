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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Country::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Type::class)->onDelete('cascade');
            // $table->foreignIdFor(\App\Models\Spec::class)->onDelete('cascade');
            
            $table->dateTime('year_of_manufacture');
            $table->dateTime('rental_cost_basis');

            $table->integer('driver_salary');
            $table->integer('rental_basis');

            $table->text('make');
            $table->text('name');
            $table->enum('plate_no', [true,false])->default(true);
            $table->enum('chasis_no', [true,false])->default(true);
            $table->enum('engine_no', [true,false])->default(true);
            $table->enum('serial_no', [true,false])->default(true);

            $table->text('model');
            $table->text('owner_ship');
            $table->text('operator');
            $table->text('responsible_person');
            $table->text('project_allocated_to');
            $table->text('email');

            $table->dateTime('registration_expiry');
            $table->dateTime('expiry_reminder_sent');
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
