<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
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
            'equipment_id'           => ['required','numeric'],
            'last_service_km'        => ['required','numeric'],
            'next_service_dueon_km'  => ['required','numeric'],
            'actual_service_reading' => ['required','numeric'],
            'non_scheduled'          => ['required'],
            'scheduled'              => ['required'],
            'last_service_date'      => ['required'],
            'next_service_date'      => ['required'],
            'actual_service_date'    => ['required'],
        ];

        return $rules;

    }//end of rules

}//end of request
