<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citys = ['Khartoum','heglig'];

        foreach ($citys as $city) {
            
            \App\Models\City::create([
                'name'       => $city,
                'user_id'    => 1,
                'country_id' => 1,
            ]);

        }//end of each

        $souths = ['tharjath', 'paloche','unity','juba'];

        foreach ($souths as $south) {
            
            \App\Models\City::create([
                'name'       => $south,
                'user_id'    => 1,
                'country_id' => 2,
            ]);

        }//end of each

    }//end of run
    
}//end of class
