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
            'break_down_duration'    => ['required','numeric'],
            'hours_worked'           => ['required'],
            'working_status'         => ['required','in:breakdown,working'],
            'break_down_description' => ['required','string'],
            'as_of'                  => ['required'],
            'break_down_date'        => ['required'],
        ];

        return $rules;

    }//end of rules

}//end of request