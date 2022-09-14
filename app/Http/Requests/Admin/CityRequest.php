<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
            'country_id' => ['required','numeric'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $citys = $this->route()->parameter('city');

            $rules['name'] = ['required','min:2','max:255', Rule::unique('cities')->ignore($citys->id)];

        } else {

            $rules['name'] = ['required','min:2','max:255','unique:cities'];

        }//end of if

        return $rules;

    }//end of rules

}//end of request

