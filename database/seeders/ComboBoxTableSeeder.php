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

        $owner_ships = ['SC','SP','NSF', 'SP &NSF', 'Rented'];

        foreach ($owner_ships as $owner_ship) {
            
            \App\Models\ComboBox::create([
                'name'    => $owner_ship,
                'type'    => 'owner_ship',
                'user_id' => 1,
            ]);

        }//end of each

        $equipments = ['equipment one','equipment tow','equipment three'];

        foreach ($equipments as $equipment) {
            
            \App\Models\ComboBox::create([
                'name'    => $equipment,
                'type'    => 'equipment',
                'user_id' => 1,
            ]);

        }//end of each

        $types = ['type one','type tow','type three'];

        foreach ($types as $type) {
            
            \App\Models\ComboBox::create([
                'name'    => $type,
                'type'    => 'type',
                'user_id' => 1,
            ]);

        }//end of each

        $rental_basis = ['Daily','Monthly'];

        foreach ($rental_basis as $rental) {
            
            \App\Models\ComboBox::create([
                'name'    => $rental,
                'type'    => 'rental_basis',
                'user_id' => 1,
            ]);

        }//end of each

        $operators = ['driver','operator tow'];

        foreach ($operators as $operator) {
            
            \App\Models\ComboBox::create([
                'name'    => $operator,
                'type'    => 'operator',
                'user_id' => 1,
            ]);

        }//end of each


        $responsible_person = ['person one','person tow'];

        foreach ($responsible_person as $person) {
            
            \App\Models\ComboBox::create([
                'name'    => $person,
                'type'    => 'responsible_person',
                'user_id' => 1,
            ]);

        }//end of each


        $responsible_person_emails = ['gopakumar@star-contracting.com','new@star-contracting.com'];

        foreach ($responsible_person_emails as $email) {
            
            \App\Models\ComboBox::create([
                'name'    => $email,
                'type'    => 'responsible_person_email',
                'user_id' => 1,
            ]);

        }//end of each

        $allocated_tos = ['General','Project'];

        foreach ($allocated_tos as $allocated_to) {
            
            \App\Models\ComboBox::create([
                'name'    => $allocated_to,
                'type'    => 'allocated_to',
                'user_id' => 1,
            ]);

        }//end of each

        $project_allocated_tos = ['project_allocated_to one','project_allocated_to tow'];

        foreach ($project_allocated_tos as $allocated) {
            
            \App\Models\ComboBox::create([
                'name'    => $allocated,
                'type'    => 'project_allocated_to',
                'user_id' => 1,
            ]);

        }//end of each

        $insurers = ['insurer one','insurer tow', 'insurer three'];

        foreach ($insurers as $insurer) {
            
            \App\Models\ComboBox::create([
                'name'    => $insurer,
                'type'    => 'insurer',
                'user_id' => 1,
            ]);

        }//end of each

        $locations = ['location one','location tow', 'location three'];

        foreach ($locations as $location) {
            
            \App\Models\ComboBox::create([
                'name'    => $location,
                'type'    => 'location',
                'user_id' => 1,
            ]);

        }//end of each

        $non_scheduleds = ['Preventive Maintenance','Breakdown'];

        foreach ($non_scheduleds as $scheduled) {
            
            \App\Models\ComboBox::create([
                'name'    => $scheduled,
                'type'    => 'non_scheduled',
                'user_id' => 1,
            ]);

        }//end of each

        $units = ['Gallons', 'Litres'];

        foreach ($units as $unit) {
            
            \App\Models\ComboBox::create([
                'name'    => $unit,
                'type'    => 'unit',
                'user_id' => 1,
            ]);

        }//end of each

        $fuel_types = ['Petrol','Diesel'];

        foreach ($fuel_types as $fuel_type) {
            
            \App\Models\ComboBox::create([
                'name'    => $fuel_type,
                'type'    => 'fuel_type',
                'user_id' => 1,
            ]);

        }//end of each

        $spec_types = ['Vehicle', 'Equipment'];

        foreach ($spec_types as $spec_type) {
            
            \App\Models\ComboBox::create([
                'name'    => $spec_type,
                'type'    => 'spec_type',
                'user_id' => 1,
            ]);

        }//end of each


        $type_insurances = ['Third Party', 'Comprehensive', 'Motor Private Comprehensive'];

        foreach ($type_insurances as $type_insura) {
            
            \App\Models\ComboBox::create([
                'name'    => $type_insura,
                'type'    => 'type_of_insurance',
                'user_id' => 1,
            ]);

        }//end of each

    }//end of run
    
}//end of class
