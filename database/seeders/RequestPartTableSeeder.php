<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RequestPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request_parts = ['request_parts one','request_parts tow','request_parts three','request_parts for'];

        foreach ($request_parts as $request_part) {
            
            \App\Models\RequestPart::create([
                'eir_id'            => 1,
                'user_id'           => 1,
                'quantity'          => 13,
                'requested_part'    => $request_part,
                'requested_part_no' => $request_part,
                'unit'              => "$request_part unit",
            ]);

        }//end of each

    }//end of run

}//end of seed
