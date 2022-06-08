<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EirRequest extends FormRequest
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
            'equipment_id'                   => ['required','numeric'],
            'eir_no'                         => ['required','numeric'],
            'description'                    => ['required'],
            'status'                         => ['required'],
            'date'                           => ['required'],
            'expected_process_date'          => ['required'],
            'expected_po_released_date'      => ['required'],
            'expected_payment_transfer_date' => ['required'],
            'expected_shipment_pickup_date'  => ['required'],
            'expected_arrival_to_site_date'  => ['required'],
            'actual_process_date'            => ['required'],
            'actual_po_released_date'        => ['required'],
            'actual_payment_transfer_date'   => ['required'],
            'actual_shipment_pickup_date'    => ['required'],
            'actual_arrival_to_site_date'    => ['required'],
        ];

        if (in_array($this->method(), ['post'])) {

            $rules['attachments'] = ['required'];

        }//end of if

        return $rules;

    }//end of rules

}//end of request