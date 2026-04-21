<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'login_id' => 'required|integer|unique:users,login_id|min:2|max:100',
            'name' => 'required|string|min:1|max:20',
            'email' => 'required|email|string|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'login_id.required' => 'IDは必須です',
            'login_id.integer' => 'IDは数字で入力してください',
            'login_id.unique' => 'IDが他人と重複しています',
            'login_id.min' => 'IDは2以上からです',
            'login_id.max' => 'IDは100までです',

            'name.required' => '名前は必須です',
            'name.min' => '名前は1文字以上で入力してください',
            'name.max' => '名前は20文字以内で入力してください',

            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式が正しくありません',
            'email.unique' => '既に存在しているメールアドレスです',

            'password.required' => 'パスワードは必須です',
            'password.confirmed' => 'パスワードが一致しません',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ];
    }
}
