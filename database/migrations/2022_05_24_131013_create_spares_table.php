<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spares', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Equipment::class)->onDelete('cascade');

            $table->integer('freight_charges_till_site');
            $table->integer('cost_of_spare');
            $table->integer('location_of_spare');

            $table->text('spare_name');
            $table->text('spare_part_no');
            $table->string('usage_description');
            $table->enum('used',['yes','no']);
            $table->string('attachments');
            
            $table->dateTime('usage_date');
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
        Schema::dropIfExists('spares');
    }
}
