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
            'claim_amount'        => ['required_if:claim,==,1','numeric'],
            'insurance_duration'  => ['required','numeric'],
            'policy_number'       => ['required'],
            'premium'             => ['required','numeric'],
            'insurer'             => ['required','min:2','max:255'],
            'claim_description'   => ['required_if:claim,==,1'],
            'type_of_insurance'   => ['required','min:2','max:255'],
            'claim'               => ['nullable','in:1,0','numeric'],
            'claim_date'          => ['required_if:claim,==,1','date'],
            'insurance_start_date'=> ['required','date'],
            'insurance_expiry'    => ['required','date'],
            'attachments'         => ['nullable','array'],
        ];

        return $rules;

    }//end of rules

    // public function attributes()
    // {
    //     return [
    //         'claim' => 'equipment',
    //     ];
    // }

    public function messages()
    {
        return [
            'claim_amount.required_if' => 'The claim amount field is required when claim is Yes',
            'claim_date.required_if' => 'The claim date field is required when claim is Yes',
            'claim_description.required_if' => 'The claim description field is required when claim is Yes',
        ];
    }

}//end of request
