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
            'description'            => ['required'],
            'part_no'                => ['required'],
            'used'                   => ['required'],
            'freight_charges'        => ['required','numeric'],
            'cost'                   => ['required','numeric'],
            'location'               => ['required','numeric'],
            'usage_date'             => ['required'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['attachments'] = ['required'];

        }

        return $rules;

    }//end of rules

}//end of request