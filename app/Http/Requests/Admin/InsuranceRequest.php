<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceRequest extends FormRequest
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
            'equipment_id'        => ['required','numeric'],
            'claim_amount'        => ['nullable','required_if:claim,==,1','numeric'],
            'insurance_duration'  => ['required','numeric'],
            'policy_number'       => ['required'],
            'premium'             => ['required','numeric'],
            'insurer'             => ['required','min:2','max:255'],
            'claim_description'   => ['required_if:claim,==,1'],
            'type_of_insurance'   => ['required','min:2','max:255'],
            'claim'               => ['nullable','in:1,0','numeric'],
            'claim_date'          => ['nullable','required_if:claim,==,1','date'],
            'insurance_start_date'=> ['required','date'],
            'insurance_expiry'    => ['required','date'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['attachments'] = ['required', 'array'];
        }

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'claim_date'            => request()->claim_date ?? NULL,
            'claim_amount'          => request()->claim_amount ?? NULL,
            'claim_description'     => request()->claim_description ?? NULL,
        ]);

    }//end of prepare for validation

}//end of request
