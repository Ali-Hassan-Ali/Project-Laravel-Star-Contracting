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
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            
            $table->integer('last_service_km')->nullable();
            $table->integer('next_service_dueon_km')->nullable();
            $table->integer('actual_service_reading');

            $table->string('non_scheduled')->nullable();
            $table->enum('scheduled',['1', '0'])->default('0');

            $table->date('last_service_date')->nullable();
            $table->date('next_service_date')->nullable();
            $table->date('actual_service_date');

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
