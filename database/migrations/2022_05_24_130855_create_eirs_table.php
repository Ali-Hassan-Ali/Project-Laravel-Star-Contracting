<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eirs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Equipment::class)->onDelete('cascade');
            $table->integer('eir_no');
            
            $table->text('eir_status');
            $table->string('attachments');
            $table->enum('eir_eq_idle',['yes','no']);
            $table->dateTime('eir_date');

            $table->dateTime('expected_process_date');
            $table->dateTime('expected_po_released_date');
            $table->dateTime('expected_payment_transfer_date');
            $table->dateTime('expected_shipment_pickup_date');
            $table->dateTime('expected_arrival_to_site_date');
            $table->dateTime('actual_process_Date');
            $table->dateTime('actual_po_released_date');
            $table->dateTime('actual_payment_transfer_date');
            $table->dateTime('actual_shipment_pickup_date');
            $table->dateTime('actual_arrival_to_site_date');
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
        Schema::dropIfExists('eirs');
    }
}