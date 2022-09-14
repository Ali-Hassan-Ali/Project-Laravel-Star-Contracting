<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FuelRequest extends FormRequest
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
            'equipment_id'             => ['required','numeric'],
//            'unit'                     => ['required','string','min:2','max:255'],
            'fuel_type'                => ['required','string'],
            'no_of_units_filled'       => ['required','numeric'],
            'last_mileage_reading'     => ['nullable','numeric'],
            'current_mileage_reading'  => ['nullable','numeric'],
            'average_mileage_reading'  => ['required','numeric'],
            'fuel_rate_per_litre'      => ['required','numeric'],
            'hours_worked_weekly'      => ['nullable','numeric'],
            'total_cost_of_fuel'       => ['required','numeric'],
            'project'                  => ['required','string'],
            'last_date'                => ['required','date'],
        ];

        return $rules;

    }//end of rules

}//end of request