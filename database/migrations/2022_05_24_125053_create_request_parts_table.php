<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Eir::class)->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            $table->integer('quantity');

            $table->text('requested_part');
            $table->text('requested_part_no');
            $table->text('unit');

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
        Schema::dropIfExists('request_parts');
    }
}
