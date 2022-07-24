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
                'freight_charges'   => 1,
                'cost'              => 1,
                'location'          => 1,
                'equipment_id'      => 1,
                'user_id'           => 1,
                'name'              => 'spare name',
                'part_no'           => 'part no',
                'description'       => "description $spare",
                'used'              => '1',
                'attachments'       => 'default.png',
                'usage_date'        => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
