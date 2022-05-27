<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name'  => ['required','min:2','max:255'],
            'email' => ['required','email','min:2','max:255', Rule::unique('users')->ignore(auth()->id())],
            'image' => ['required','sometimes','nullable','image'],
        ];

        return $rules;

    }//end of rules

}//end of request
