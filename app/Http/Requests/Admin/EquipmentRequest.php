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
            'type'                  => ['required','string','min:2','max:255'],
            'owner_ship'            => ['required','string','min:2','max:255'],
            'operator'              => ['required','string','min:2','max:255'],
            'responsible_person'    => ['required','string','min:2','max:255'],
            'project_allocated_to'  => ['nullable','string','min:2','max:25'],
            'allocated_to'          => ['required','string','min:2','max:25'],
            'email'                 => ['required','email'],
            'driver_salary'         => ['required','numeric'],
            'registration_expiry'   => ['required','string','min:2','max:255'],
            'expiry_reminder_sent'  => ['required','string','min:2','max:255'],
            'year_of_manufacture'   => ['required','string','min:2','max:255'],
            'rental_basis'          => ['nullable','string','min:2','max:255'],
            'rental_cost_basis'     => ['nullable','numeric'],
            'spec_id'               => ['required','numeric'],
            'country_id'            => ['required','numeric'],
            'city_id'               => ['required','numeric'],
            'plate_no'              => ['required','string'],
            'chasis_no'             => ['required','string'],
            'engine_no'             => ['required','string'],
            'serial_no'             => ['required','string'],
            'country_id'            => ['required','numeric'],
        ];

        return $rules;

    }//end of rules

}//end of request