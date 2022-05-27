<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'                  => ['required','string','min:2','max:255'],
            'make'                  => ['required','string','min:2','max:255'],
            'model'                 => ['required','string','min:2','max:255'],
            'owner_ship'            => ['required','string','min:2','max:255'],
            'operator'              => ['required','string','min:2','max:255'],
            'responsible_person'    => ['required','string','min:2','max:255'],
            'project_allocated_to'  => ['required','string','min:2','max:25'],
            'email'                 => ['required','email'],
            'driver_salary'         => ['required','string','min:2','max:255'],
            'rental_basis'          => ['required','string','min:2','max:255'],
            'registration_expiry'   => ['required','string','min:2','max:255'],
            'expiry_reminder_sent'  => ['required','string','min:2','max:255'],
            'year_of_manufacture'   => ['required','string','min:2','max:255'],
            'rental_cost_basis'     => ['required','string','min:2','max:255'],
            'country_id'            => ['required','numeric'],
            'plate_no'              => ['required','numeric'],
            'chasis_no'             => ['required','numeric'],
            'engine_no'             => ['required','numeric'],
            'serial_no'             => ['required','numeric'],
            'country_id'            => ['required','numeric'],
            'type_id'               => ['required','numeric'],
        ];

        return $rules;

    }//end of rules

}//end of request