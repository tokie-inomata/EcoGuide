<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpotRequest extends FormRequest
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
            'name'         => 'required',
            'prefecture'   => 'required',
            'city'         => 'required',
            'house_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '必須項目です。',
            'prefecture.required' => '都道府県が選ばれていません。',
            'city.required' => '必須項目です。',
            'house_humber.required' => '必須項目です。',
        ];
    }
}
