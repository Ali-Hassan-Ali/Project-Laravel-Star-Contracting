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
            'break_down_duration'    => ['nullable'],
            // 'hours_worked'           => ['required_if:working_status,Breakdown,Working'],
            'hours_worked'           => ['nullable'],
            'working_status'         => ['required','in:breakdown,working'],
            // 'break_down_description' => ['required_if:working_status,Breakdown,Working'],
            'break_down_description' => ['nullable'],
            'as_of'                  => ['required'],
            'break_down_date'        => ['nullable'],
        ];

        return $rules;

    }//end of rules

}//end of request