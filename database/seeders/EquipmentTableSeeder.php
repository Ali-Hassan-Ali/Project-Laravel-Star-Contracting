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
                'year_of_manufacture'   => now(),
                'rental_cost_basis' => now(),
                'driver_salary'         => 200,
                'type'                  => 'type',
                'make'                  => 'make',
                'plate_no'              => true,
                'chasis_no'             => true,
                'engine_no'             => true,
                'serial_no'             => true,
                'model'                 => 'Lexus',
                'owner_ship'            => 'name owner ship',
                'rental_basis'          => 200,
                'operator'              => 'name operator',
                'responsible_person'    => 'name responsible person',
                'project_allocated_to'  => 'ali',
                'email'                 => 'ali#gmail.com',
                'registration_expiry'   => now(),
                'expiry_reminder_sent'  => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
