<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeRequest extends FormRequest
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
            'city_id'    => ['required','numeric'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $types = $this->route()->parameter('type');

            $rules['name'] = ['required','min:2','max:255', Rule::unique('types')->ignore($types->id)];

        } else {

            $rules['name'] = ['required','min:2','max:255','unique:types'];

        }//end of if

        return $rules;

    }//end of rules

}//end of request
