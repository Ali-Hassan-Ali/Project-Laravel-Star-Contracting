<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eirs = ['Eir one','Eir tow','Eir for','Eir 5','Eir 6'];

        foreach ($eirs as $eir) {
            
            \App\Models\Eir::create([
                'equipment_id'                   => 1,
                'user_id'                        => 1,
                'eir_no'                         => 13,
                'description'                    => $eir,
                'date'                           => now(),
                'expected_process_date'          => now(),
                'expected_po_released_date'      => now(),
                'expected_payment_transfer_date' => now(),
                'expected_shipment_pickup_date'  => now(),
                'expected_arrival_to_site_date'  => now(),
                'actual_process_date'            => now(),
                'actual_po_released_date'        => now(),
                'actual_payment_transfer_date'   => now(),
                'actual_shipment_pickup_date'    => now(),
                'actual_arrival_to_site_date'    => now(),
            ]);

        }//end of each

    }//end of run
    
}//end of class
