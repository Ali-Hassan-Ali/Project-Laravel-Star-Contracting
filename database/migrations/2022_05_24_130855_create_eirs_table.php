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
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            $table->integer('eir_no');
            
            $table->string('attachments')->default('attachments_eirs_file/default.png');
            $table->string('status')->nullable();

            $table->date('date');
            $table->date('expected_process_date');
            $table->date('expected_po_released_date');
            $table->date('expected_payment_transfer_date');
            $table->date('expected_shipment_pickup_date');
            $table->date('expected_arrival_to_site_date');
            $table->date('actual_process_date');
            $table->date('actual_po_released_date');
            $table->date('actual_payment_transfer_date');
            $table->date('actual_shipment_pickup_date');
            $table->date('actual_arrival_to_site_date');

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
        Schema::dropIfExists('eirs');
    }
}
