<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Equipment::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');

            $table->text('unit');
            $table->text('fuel_type');

            $table->integer('no_of_units_filled');
            $table->integer('last_mileage_reading');
            $table->integer('current_mileage_reading');
            $table->integer('average_mileage_reading');
            $table->integer('fuel_rate_per_litre');
            $table->integer('hours_worked_weekly');
            $table->integer('total_cost_of_fuel');
            
            $table->dateTime('last_date');
            $table->dateTime('next_date');

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
        Schema::dropIfExists('fuels');
    }
}
