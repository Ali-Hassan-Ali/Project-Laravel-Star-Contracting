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
            'description'            => ['nullable','required_if:used,==,1','string'],
            'usage_date'             => ['nullable','required_if:used,==,1','date'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['attachments'] = ['required','array'];

        }

        return $rules;

    }//end of rules


    protected function prepareForValidation()
    {
        return $this->merge([
            'usage_date'    => request()->usage_date ?? NULL,
            'description'   => request()->description ?? NULL,
        ]);

    }//end of prepare for validation

    public function messages()
    {
        return [
            'usage_date.required_if' => 'The usage date field is required when used is Yes',
            'description.required_if' => 'The description field is required when used is Yes',
        ];
    }

}//end of request