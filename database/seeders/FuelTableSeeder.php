<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FuelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuels = ['fuels one','fuels tow','fuels 3','fuels 4'];

        foreach ($fuels as $fuel) {
            
            \App\Models\Fuel::create([
                'equipment_id'           => 1,
                'user_id'                => 1,
                'unit'                   => $fuel,
                'fuel_type'              => "fuel_type $fuel",
                'no_of_units_filled'     => 49,
                'last_mileage_reading'   => 40,
                'current_mileage_reading'=> 30,
                'average_mileage_reading'=> 30,
                'fuel_rate_per_litre'    => 30,
                'hours_worked_weekly'    => 30,
                'total_cost_of_fuel'     => 30,
                'last_date'              => now(),
                'next_date'              => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
