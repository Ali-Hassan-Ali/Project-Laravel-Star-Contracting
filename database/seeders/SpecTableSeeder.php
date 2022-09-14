<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpecTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Equipmentspecs = ['others','earth moving'];

        foreach ($Equipmentspecs as $Equipme) {
            
            \App\Models\Spec::create([
                'name'    => $Equipme,
                'type'    => 'Equipment',
                'user_id' => 1,
            ]);

        }//end of each

        $Vehiclespecs = ['lightweight','heavyweight'];

        foreach ($Vehiclespecs as $Vehicle) {

            \App\Models\Spec::create([
                'name'    => $Vehicle,
                'type'    => 'Vehicle',
                'user_id' => 1,
            ]);

        }//end of each

    }//end of run
    
}//end of class
