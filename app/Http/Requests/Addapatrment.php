<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Addapatrment extends FormRequest
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
        return [
          'Titel'=> "required",
          'type'=> "required",
          'floor'=> "required",
          'city'=> "required",
          'state'=> "required",
          'dimensions'=> "required",
          'small_room'=> "required",
         'medium_room'=> "required",
         'large_room'=> "required",
         'extra_large_room'=> "required",
        'street'=> "required",
         'Description'=> "required",
         'price'=> "required",
         'lat' => "required",
         'lng'=> "required", 
         'class'=> "required",
         'imageFile' => 'required',
         'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ];
    }
}
