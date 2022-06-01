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
            'premium'             => ['required','numeric'],
            'insurance_duration'  => ['required','numeric'],
            'claim_amount'        => ['required','numeric'],
            'policy_number'       => ['required','numeric'],
            'insurer'             => ['required'],
            'claim_description'   => ['required'],
            'type_of_insurance'   => ['required'],
            'claims'              => ['required'],
            'claim_date'          => ['required'],
            'insurance_start_date'=> ['required'],
            'insurance_expiry'    => ['required'],
        ];

        if (in_array($this->method(), ['POST'])) {

            $rules['claim_attachments'] = ['required'];
        }

        return $rules;

    }//end of rules

}//end of request
