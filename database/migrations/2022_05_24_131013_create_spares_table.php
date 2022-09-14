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
            $table->json('equipments');
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');

            $table->integer('cost');
            $table->integer('freight_charges');
            
            $table->string('name');
            $table->string('part_no');

            $table->enum('used', ['1', '0'])->default('0');
            
            $table->date('usage_date')->nullable();
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
