<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequset extends FormRequest
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

            'number_room' => 'required',

           

        ];
    }
    public function messages()
    {
        return [
            'number_room.required' =>'يجب ادخال البيانات غى هذا الحقل',
          
            
        ];
    }
}
