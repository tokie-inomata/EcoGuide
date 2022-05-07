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
            'recycling_item_id' => 'required',
        ];
    }
}