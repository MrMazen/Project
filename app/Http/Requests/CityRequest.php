<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|unique:Citys|max:255',

            'provices_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>'يجب ادخال البيانات غى هذا الحقل',
            'name.unique' =>'يجب عدم تكرار الاسم',
            'provices_id.required' =>'يجب ادخال البيانات فى اسم المحافظة',

        ];
}
}
