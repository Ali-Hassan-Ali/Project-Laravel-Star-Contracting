<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComboBoxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makes = ['make one','make tow','make three'];

        foreach ($makes as $make) {
            
            \App\Models\ComboBox::create([
                'name'    => $make,
                'type'    => 'make',
                'user_id' => 1,
            ]);

        }//end of each

        $models = ['model one','model tow','model three'];

        foreach ($models as $model) {
            
            \App\Models\ComboBox::create([
                'name'    => $model,
                'type'    => 'model',
                'user_id' => 1,
            ]);

        }//end of each

        $owner_ships = ['owner_ship one','owner_ship tow','owner_ship three'];

        foreach ($owner_ships as $owner_ship) {
            
            \App\Models\ComboBox::create([
                'name'    => $owner_ship,
                'type'    => 'owner_ship',
                'user_id' => 1,
            ]);

        }//end of each

    }//end of run
    
}//end of class
