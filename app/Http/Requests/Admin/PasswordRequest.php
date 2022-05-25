<?php

namespace App\Http\Requests\Admin;

use App\Rules\CheckOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password' => ['required', new CheckOldPassword],
            'password' => 'required|confirmed'
        ];

        return $rules;

    }//end of rules

}//end of request
