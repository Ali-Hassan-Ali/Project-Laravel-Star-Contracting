<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spares = ['description truck','description shipping','description Transfer','description','description'];

        foreach ($spares as $spare) {
            
            \App\Models\Spare::create([
                'equipment_id'      => 1,
                'user_id'           => 1,
                'cost'              => 1,
                'freight_charges'   => 20,
                'name'              => 'spare name',
                'part_no'           => 'part no',
                'used'              => '1',
                'usage_date'        => now(),
                'description'       => "description $spare",
            ]);

        }//end of each

    }//end of run
    
}//end of class
