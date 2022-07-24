<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['make', 'model', 'owner_ship', 
                                  'equipment', 'type', 'rental_basis', 
                                  'operator', 'responsible_person', 
                                  'responsible_person_email', 'allocated_to', 'project_allocated_to',
                                  'insurer', 'location', 'non_scheduled'])->nullable();

            $table->foreignIdFor(\App\Models\User::class);

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
        Schema::dropIfExists('combo_boxes');
    }
}
