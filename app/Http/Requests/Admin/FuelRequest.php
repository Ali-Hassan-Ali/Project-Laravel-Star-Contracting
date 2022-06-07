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
            'unit'                     => ['required','string'],
            'fuel_type'                => ['required','string'],
            'no_of_units_filled'       => ['required','string'],
            'last_mileage_reading'     => ['required','string'],
            'current_mileage_reading'  => ['required','string'],
            'average_mileage_reading'  => ['required','string'],
            'fuel_rate_per_litre'      => ['required','string'],
            'hours_worked_weekly'      => ['required','string'],
            'total_cost_of_fuel'       => ['required','string'],
            'last_date'                => ['required'],
            'next_date'                => ['required'],
        ];

        return $rules;

    }//end of rules

}//end of request