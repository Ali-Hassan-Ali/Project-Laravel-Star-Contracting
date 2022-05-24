<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->double('plate')->default(true);
            $table->string('car_model');
            $table->string('car_brand');
            $table->string('mechanic_name');
            $table->string('maifunction');
            $table->date('date_of_recieve');
            $table->date('date_of_send');
            $table->string('services_cost');
            $table->string('insurance_scan')->default('insurance_scan_image/default.png');
            $table->string('registeration_scan')->default('registeration_scan_image/default.png');
            
            $table->foreignIdFor(\App\Models\Admin::class);
            $table->foreignIdFor(\App\Models\City::class);

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
        Schema::dropIfExists('vehicles');
    }
}
