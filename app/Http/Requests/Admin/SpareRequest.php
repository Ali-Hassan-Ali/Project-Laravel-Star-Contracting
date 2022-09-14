<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SpareRequest extends FormRequest
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
            'equipments'             => ['required','array'],
            'name'                   => ['required','min:2','max:255'],
            'part_no'                => ['required','min:2','max:255'],
            'used'                   => ['nullable','in:1,0'],
            'freight_charges'        => ['required','numeric'],
            'cost'                   => ['required','numeric'],
            'description'            => ['required_if:used,==,1'],
            'usage_date'             => ['required_if:used,==,1','date'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['attachments'] = ['required','array'];

        }

        return $rules;

    }//end of rules

}//end of request