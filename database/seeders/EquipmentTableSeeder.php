<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipmens = ['car 1','car 2','car 3'];

        foreach ($equipmens as $equipmen) {
            
            \App\Models\Equipment::create([
                'name'       => $equipmen,
                'user_id'    => 1,
                'country_id' => 1,
                'city_id'    => 1,
                'spec_id'    => 1,
                'year_of_manufacture'   => '112',
                'rental_cost_basis'     => '11',
                'driver_salary'         => '200',
                'rental_basis'          => '200',
                'make'                  => 'make three',
                'name'                  => 'name Equipment',
                'type'                  => 'Equipment',
                'plate_no'              => true,
                'chasis_no'             => true,
                'engine_no'             => true,
                'serial_no'             => true,
                'model'                 => 'Lexus',
                'owner_ship'            => 'SC',
                'operator'              => 'Driver',
                'responsible_person'    => 'name responsible person',
                'project_allocated_to'  => json_encode(["Project_allocated_to one","Project_allocated_to tow"]),
                'allocated_to'          => 'Project',
                'email'                 => 'new@star-contracting.com',
                'registration_expiry'   => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
