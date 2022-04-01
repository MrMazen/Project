<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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

            'name' => 'required|unique:orders|max:255',
            'number_phone' => 'required|unique:orders|max:11',
            'section_id' => 'required',
            'Room_id' => 'required',
            


        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'يجب ادخال البيانات غى هذا الحقل',
            'name.unique' =>'يجب عدم تكرار الاسم',
            'section_id.required' =>'يجب ادخال البيانات فى اسم المحافظه',
            'Room_id.required' =>'يجب ادخال البيانات فى اسم المدينه',
           

        ];
    }
}
