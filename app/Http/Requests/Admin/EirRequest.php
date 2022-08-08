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
            'status'                         => ['required'],
            'date'                           => ['required','date'],
            'expected_process_date'          => ['required','date'],
            'expected_po_released_date'      => ['required','date'],
            'expected_payment_transfer_date' => ['required','date'],
            'expected_shipment_pickup_date'  => ['required','date'],
            'expected_arrival_to_site_date'  => ['required','date'],
            'actual_process_date'            => ['required','date'],
            'actual_po_released_date'        => ['required','date'],
            'actual_payment_transfer_date'   => ['required','date'],
            'actual_shipment_pickup_date'    => ['required','date'],
            'actual_arrival_to_site_date'    => ['required','date'],
        ];

        if (in_array($this->method(), ['post'])) {

            $rules['attachments'] = ['required', 'array'];

        }//end of if

        return $rules;

    }//end of rules

}//end of request