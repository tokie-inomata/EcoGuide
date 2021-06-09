<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'             => 'required',
            'email'            => 'required|email',
            'password'         => 'required',
            'password-confirm' => 'password_confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                       => '必須項目です。',
            'email.required'                      => '必須項目です。',
            'email.email'                         => 'メールアドレス形式で記述してください。',
            'password.required'                   => '必須項目です。',
            'password-confirm.password_confirmed' => 'パスワードが一致しません。',
        ];
    }
}
