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
            'claim_amount'        => ['nullable','numeric'],
            'insurance_duration'  => ['required','min:2','max:255'],
            'policy_number'       => ['required','min:2','max:255'],
            'premium'             => ['required','min:2','max:255'],
            'insurer'             => ['required','min:2','max:255'],
            'claim_description'   => ['required_if:claim,==,1'],
            'type_of_insurance'   => ['required','min:2','max:255'],
            'claim'               => ['nullable','in:1,0','numeric'],
            'claim_date'          => ['nullable','min:2','max:255'],
            'insurance_start_date'=> ['required','min:2','max:255'],
            'insurance_expiry'    => ['required','min:2','max:255'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['claim_attachments'] = ['required'];
        }

        return $rules;

    }//end of rules

}//end of request
