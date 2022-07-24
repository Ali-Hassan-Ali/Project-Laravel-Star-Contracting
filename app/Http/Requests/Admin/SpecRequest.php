<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SpecRequest extends FormRequest
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
            'description'  => ['nullable','string'],
            'type_spec'    => ['required','min:2','max:255'],
            'name'         => ['nullable','min:2','max:255'],
            'country_id'   => ['nullable','numeric'],
            'city_id'      => ['nullable','numeric'],
        ];

        return $rules;

    }//end of rules

}//end of request