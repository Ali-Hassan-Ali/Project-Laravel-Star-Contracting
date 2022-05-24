<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(UserSeeder::class);
        
    }//end of run

}//en dof run
