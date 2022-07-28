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
            'equipment_id'           => ['required','numeric'],
            'name'                   => ['required','min:2','max:255'],
            'part_no'                => ['required','min:2','max:255'],
            'used'                   => ['nullable', 'in:1,0'],
            'freight_charges'        => ['required','min:2','max:255'],
            'cost'                   => ['required','min:2','max:255'],
            'city_id'                => ['required','numeric'],
            'description'            => ['required_if:used,==,1','min:2','max:255'],
            'usage_date'             => ['required_if:used,==,1','date'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['attachments'] = ['required'];

        }

        return $rules;

    }//end of rules

}//end of request