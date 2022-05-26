<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Equipment::class)->onDelete('cascade');
            
            $table->integer('last_service_km/hmr');
            $table->integer('next_service_dueon_km/hmr');
            $table->integer('actual_service_reading_km/hmr');

            $table->text('non_scheduled');
            $table->enum('scheduled',['yes','no']);

            $table->dateTime('last_service_date');
            $table->dateTime('next_service_date');
            $table->dateTime('actual_service_date');

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
        Schema::dropIfExists('maintenances');
    }
}
