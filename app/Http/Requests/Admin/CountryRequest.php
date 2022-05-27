<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $countrys = $this->route()->parameter('country');

            $rules['name'] = ['required','min:2','max:255', Rule::unique('countries')->ignore($countrys->id)];

        } else {

            $rules['name'] = ['required','min:2','max:255','unique:countries'];

        }//end of if

        return $rules;

    }//end of rules

}//end of request
