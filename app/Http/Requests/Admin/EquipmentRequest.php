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

        // dd(\Request::all());
        $rules = [
            'name'                  => ['required','string','min:2','max:255'],
            'make'                  => ['required','string','min:2','max:255'],
            'type'                  => ['required','string','min:2','max:255'],
            'owner_ship'            => ['required','string','min:2','max:255'],
            'operator'              => ['required','string','min:2','max:255'],
            'responsible_person'    => ['required','string','min:2','max:255'],
            'project_allocated_to'  => ['required_if:allocated_to,==,Project','array'],
            'allocated_to'          => ['required','string','min:2','max:255'],
            'email'                 => ['required','email','min:2','max:255'],
            // 'driver_salary'         => ['required_if:operator,==,Driver','string','min:2','max:255'],
            'registration_expiry'   => ['required_if:type,==,Vehicle'],
            'year_of_manufacture'   => ['nullable','string','min:2','max:255'],
            'rental_basis'          => ['required_if:owner_ship,==,Rented','string','min:2','max:255'],
            'rental_cost_basis'     => ['required_if:owner_ship,==,Rented','numeric'],
            'spec_id'               => ['required','numeric'],
            'country_id'            => ['required','numeric'],
            'city_id'               => ['required','numeric'],
            'chasis_no'             => ['nullable','string','min:2','max:255'],
            'engine_no'             => ['nullable','string','min:2','max:255'],
            'plate_no'              => ['nullable','string','min:2','max:255'],
            'serial_no'             => ['nullable','string','min:2','max:255'],
            'model'                 => ['nullable','string','min:2','max:255'],
            'attachments'           => ['nullable','array'],
        ];

        return $rules;

    }//end of rules

}//end of request