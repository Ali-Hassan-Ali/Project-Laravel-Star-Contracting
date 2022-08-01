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
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            
            $table->integer('claim_amount')->nullable();
            $table->integer('insurance_duration');
            $table->integer('premium');
            
            $table->string('policy_number');
            $table->string('insurer');
            $table->string('type_of_insurance');

            $table->text('claim_description')->nullable();
            $table->enum('claim', ['1','0'])->default('0');

            $table->date('claim_date')->nullable();
            $table->date('insurance_start_date')->nullable();
            $table->date('insurance_expiry')->nullable();

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
        Schema::dropIfExists('insurances');
    }
}
