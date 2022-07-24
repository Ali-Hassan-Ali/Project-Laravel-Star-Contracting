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
        $specs = ['spec truck','spec shipping','spec Transfer','spec for'];

        foreach ($specs as $spec) {
            
            \App\Models\Spec::create([
                'name'          => $spec,
                'type_spec'     => 'type specification',
                'user_id'       => 1,
            ]);

        }//end of each

    }//end of run
    
}//end of class
