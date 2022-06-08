<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestPartRequest extends FormRequest
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
            'eir_id'            => ['required','numeric'],
            'quantity'          => ['required','numeric'],
            'requested_part_no' => ['required'],
            'requested_part'    => ['required'],
            'unit'              => ['required'],
        ];

        return $rules;

    }//end of rules

}//end of request