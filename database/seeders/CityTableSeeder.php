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
        $citys = ['الخرطوم','امدرمان','بحري','ود مدني','كسلا','نيلا'];

        foreach ($citys as $city) {
            
            \App\Models\City::create([
                'name'     => $city,
                'admin_id' => 1,
            ]);

        }//end of each

    }//end of run
    
}//end of class
