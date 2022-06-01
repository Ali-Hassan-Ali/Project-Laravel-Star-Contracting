<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InsuranceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insurances = ['insurer 1','insurer 2','insurer 3','insurer 4','insurer 5','insurer 6','insurer 7'];

        foreach ($insurances as $insurance) {
            
            \App\Models\Insurance::create([
                'user_id'              => 1,
                'equipment_id'         => 1,
                'premium'              => 1,
                'insurer'              => $insurance,
                'type_of_insurance'    => 1,
                'insurance_start_date' => now(),
                'insurance_expiry'     => now(),
                'insurance_duration'   => 30,
                'policy_number'        => 1,
                'claims'               => true,
                'claim_date'           => now(),
                'claim_amount'         => 300,
                'claim_description'    => 'claim description',
            ]);

        }//end of each

    }//end of run
    
}//end of class