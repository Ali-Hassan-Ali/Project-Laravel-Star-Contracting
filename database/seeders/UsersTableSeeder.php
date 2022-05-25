<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'f_name' => 'bassil',
            'l_name' => 'ali',
            'phone'=>'0996813485',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('password'),
            'type' => 'super_admin',
        ]);

        $user->attachRole('super_admin');

    }//end of run

}//end of seeder
