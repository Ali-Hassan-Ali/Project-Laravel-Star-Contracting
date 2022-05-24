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
            $table->foreignIdFor(\App\Models\Site::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Type::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Spec::class)->onDelete('cascade');
            
            $table->integer('year_of_manufacture');
            $table->integer('rental_cost_per_basis');
            $table->integer('driver_salary');

            $table->text('make');
            $table->text('equipment_name');
            $table->text('plate_no');
            $table->text('chasis_no');
            $table->text('engine_no');
            $table->text('serial_no');
            $table->text('model');
            $table->text('owner_ship');
            $table->text('rental_basis');
            $table->text('operator');
            $table->text('responsible_person');
            $table->text('allocated_to');
            $table->text('project_allocated_to');
            $table->text('rp_email');

            $table->dateTime('registration_expiry');
            $table->dateTime('reg_expiry_reminder_sent');
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
