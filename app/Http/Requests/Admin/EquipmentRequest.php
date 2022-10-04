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
            'test'                  => ['required'],
            'name'                  => ['required','string','min:1','max:255'],
            'make'                  => ['required','string','min:1','max:255'],
            'type'                  => ['required','string','min:1','max:255'],
            'owner_ship'            => ['required','string','min:1','max:255'],
            'operator'              => ['nullable','string','min:1','max:255'],
            'responsible_person'    => ['required','string','min:1','max:255'],
            'project_allocated_to'  => ['nullable','required_if:allocated_to,==,Project','array'],
            'allocated_to'          => ['required','string','min:1','max:255'],
            'email'                 => ['required','email','min:1','max:255'],
            'driver_salary'         => ['nullable'],
            'registration_expiry'   => ['required_if:type,==,Vehicle','date'],
            'registration_date'     => ['required','date'],
            'year_of_manufacture'   => ['nullable','string','min:1','max:255'],
            'rental_basis'          => ['required_if:owner_ship,==,Rented,rented','string','max:255'],
            'rental_cost_basis'     => ['nullable'],
            'spec_id'               => ['required','numeric'],
            'country_id'            => ['required','numeric'],
            'city_id'               => ['required','numeric'],
            'chasis_no'             => ['nullable','string','min:1','max:255'],
            'engine_no'             => ['nullable','string','min:1','max:255'],
            'plate_no'              => ['nullable','string','min:1','max:255'],
            'serial_no'             => ['nullable','string','min:1','max:255'],
            'model'                 => ['nullable','string','min:1','max:255'],
            'attachments'           => ['nullable','array'],
        ];

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'rental_basis'        => request()->rental_basis ?? '',
            'driver_salary'       => request()->driver_salary ?? '0',
            'rental_cost_basis'   => request()->rental_cost_basis ?? '0',
            'registration_expiry' => request()->registration_expiry ?? '',
            'registration_date'   => request()->registration_date ?? '',
        ]);

    }//end of prepare for validation


}//end of request