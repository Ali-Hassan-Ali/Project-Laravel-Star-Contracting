<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'name'     => ['required','min:2','max:255'],
            'password' => ['required','confirmed'],
            'type'     => ['required'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $admin = $this->route()->parameter('admin');

            $rules['email'] = ['required','email','min:2','max:255', Rule::unique('users')->ignore($admin->id)];

        } else {

            $rules['email'] = ['required','email','unique:users','min:2','max:255'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'admin'
        ]);

    }//end of prepare for validation

}//end of request
