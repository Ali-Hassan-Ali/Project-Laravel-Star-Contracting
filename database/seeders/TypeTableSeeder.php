<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['truck','shipping','Transfer'];

        foreach ($types as $type) {
            
            \App\Models\Type::create([
                'name'          => $type,
                'user_id'       => 1,
                'country_id'    => 1,
                'city_id'       => 1,
            ]);

        }//end of each

    }//end of run
    
}//end of class
