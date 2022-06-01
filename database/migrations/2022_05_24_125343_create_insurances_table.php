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
            
            $table->integer('premium');
            $table->integer('insurance_duration');
            $table->integer('claim_amount');
            $table->integer('policy_number');
            
            $table->text('insurer');
            $table->text('claim_description');
            $table->text('type_of_insurance');
            $table->enum('claims',[true,false])->default(true);
            $table->string('attachments')->default('insurances_attachments_image/default.png');

            $table->dateTime('claim_date');
            $table->dateTime('insurance_start_date');
            $table->dateTime('insurance_expiry');

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
