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
            'name'           => 'required',
            'prefecture'     => 'required',
            'city'           => 'required',
            'house_number'   => 'required',
            'image_path'     => 'mimes:jpeg,jpg,png|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                    => '必須項目です。',
            'city.required'                    => '市区町村を入力してください。',
            'house_number.required'            => '住所を入力してください。',
            'image_path.mimes:jpeg,jpg,png'    => '登録できる拡張子(PNG,JPG)ではありません。',
            'image_path.max:1024'              => '画像データが大きすぎます。',
        ];
    }
}