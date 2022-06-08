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
        $this->call([
            LaratrustSeeder::class,
            UsersTableSeeder::class,
            CountryTableSeeder::class,
            CityTableSeeder::class,
            TypeTableSeeder::class,
            EquipmentTableSeeder::class,
            StatusTableSeeder::class,
            SpecTableSeeder::class,
            InsuranceTableSeeder::class,
            SpareTableSeeder::class,
            MaintenanceTableSeeder::class,
            FuelTableSeeder::class,
            EirTableSeeder::class,
            RequestPartTableSeeder::class,
        ]);
    }
}
