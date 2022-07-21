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

            $table->integer('freight_charges');
            $table->integer('cost');
            $table->integer('location');

            $table->string('name');
            $table->boolean('part_no')->default(true);
            $table->enum('used',[true, false])->nullable()->default(true);
            $table->string('attachments')->default('attachments_spares_file/default.png');
            
            $table->dateTime('usage_date')->nullable();
            $table->text('description')->nullable();

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
