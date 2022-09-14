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

            $table->integer('no_of_units_filled')->default(0);
            $table->integer('last_mileage_reading')->default(0);
            $table->integer('current_mileage_reading')->default(0);
            $table->integer('average_mileage_reading')->default(0);
            $table->integer('fuel_rate_per_litre')->default(0);
            $table->integer('hours_worked_weekly')->default(0);
            $table->integer('total_cost_of_fuel')->default(0);
            
            $table->date('last_date');

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
