<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComboBoxRequest extends FormRequest
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
            'name'    => ['required','string'],
            'type'    => ['required','in:make, model, owner_ship, equipment, type, rental_basis, operator, responsible_person, responsible_person_email, allocated_to, project_allocated_to, insurer, location, non_scheduled, unit, fuel_type, spec_type'],
        ];

        return $rules;

    }//end of rules

}//end of request

