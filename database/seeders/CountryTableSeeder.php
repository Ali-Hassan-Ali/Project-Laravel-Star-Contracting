<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countrys = ['sudan','south sudan'];

        foreach ($countrys as $country) {
            
            \App\Models\Country::create([
                'name'     => $country,
                'user_id'  => 1,
            ]);

        }//end of each

    }//end of run

}//end of seed
