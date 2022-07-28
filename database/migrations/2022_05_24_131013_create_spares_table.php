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
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');

            $table->string('cost');
            $table->string('freight_charges');
            $table->string('name');
            $table->string('part_no');
            $table->string('attachments')->default('attachments_spares_file/default.png');

            $table->enum('used', ['1', '0'])->default('1')->nullable();
            
            $table->dateTime('usage_date')->nullable();
            $table->text('description')->nullable();

            $table->foreignIdFor(\App\Models\Country::class)->onDelete('cascade')->nullable();
            $table->foreignIdFor(\App\Models\City::class)->onDelete('cascade');

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
        Schema::dropIfExists('spares');
    }
}
