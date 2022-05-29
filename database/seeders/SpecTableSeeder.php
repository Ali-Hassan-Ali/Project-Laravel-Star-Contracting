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
        $types = ['description truck','description shipping','description Transfer','description','description'];

        foreach ($types as $type) {
            
            \App\Models\Spec::create([
                'equipment_id'  => 1,
                'user_id'       => 1,
                'description'   => $type,
            ]);

        }//end of each

    }//end of run
    
}//end of class
