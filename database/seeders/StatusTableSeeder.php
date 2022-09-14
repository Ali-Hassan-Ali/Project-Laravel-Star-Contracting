<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Breakdown','Working'];

        foreach ($statuses as $status) {
            
            \App\Models\Status::create([
                'user_id'         => 1,
                'equipment_id'    => 1,

                'break_down_duration' => 10,
                'hours_worked'        => 20,
                'working_status'      => 'Breakdown',

                'break_down_description' => 'description',
                
                'as_of'           => now(),
                'break_down_date' => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
