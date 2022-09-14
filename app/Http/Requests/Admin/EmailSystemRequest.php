<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmailSystemRequest extends FormRequest
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
            'email'      => ['required','email'],
            'country_id' => ['required','numeric'],
            'city_id'    => ['required','numeric'],
            'type'       => ['required','in:eir,expiry,insurances,other'],
        ];

        return $rules;

    }//end of rules

}//end of request

