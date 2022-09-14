<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maintenances = ['Maintenance 1','Maintenance 2','Maintenance 3','Maintenance 4','Maintenance 5'];

        foreach ($maintenances as $maintenance) {
            
            \App\Models\Maintenance::create([
                'equipment_id'    => 1,
                'user_id'         => 1,
                'last_service_km' => 10,
                'next_service_dueon_km' => 10,
                'actual_service_reading' => 10,
                'non_scheduled'   => 'non scheduled descrption',
                'last_service_date'   => now(),
                'next_service_date'   => now(),
                'actual_service_date' => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
