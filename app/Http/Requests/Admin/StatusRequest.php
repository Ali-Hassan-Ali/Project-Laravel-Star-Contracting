<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'break_down_duration'    => ['required_if:working_status,Breakdown','numeric'],
            'hours_worked'           => ['nullable','numeric'],
            'working_status'         => ['required','in:breakdown,working'],
            'as_of'                  => ['required','date'],
            'break_down_description' => ['required_if:working_status,Breakdown'],
            'break_down_date'        => ['required_if:working_status,Breakdown', 'date'],
        ];

        return $rules;

    }//end of rules

}//end of request