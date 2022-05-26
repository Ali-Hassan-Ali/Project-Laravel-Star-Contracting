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
            'name'                  => ['required','string'],
            'country_id'            => ['required','string'],
            'make'                  => ['required','string'],
            'model'                 => ['required','string'],
            'owner_ship'            => ['required','string'],
            'operator'              => ['required','string'],
            'responsible_person'    => ['required','string'],
            'project_allocated_to'  => ['required','string'],
            'email'                 => ['required','email'],
            'driver_salary'         => ['required','string'],
            'rental_basis'          => ['required','string'],
            'registration_expiry'   => ['required','string'],
            'expiry_reminder_sent'  => ['required','string'],
            'year_of_manufacture'   => ['required','string'],
            'rental_cost_basis'     => ['required','string'],
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