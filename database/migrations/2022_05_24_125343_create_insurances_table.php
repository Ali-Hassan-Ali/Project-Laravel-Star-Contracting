<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Equipment::class)->onDelete('cascade');
            
            $table->integer('premium');
            $table->integer('insurance_duration');
            $table->integer('insurance_expiry');
            $table->integer('claimed_amount');
            
            $table->text('insurer');
            $table->text('type_of_insurance');
            $table->text('policy_number');
            $table->enum('claims',['yes','no']);
            $table->string('attachments');

            $table->dateTime('claim_date');
            $table->dateTime('insurance_start_date');
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
        Schema::dropIfExists('insurances');
    }
}
