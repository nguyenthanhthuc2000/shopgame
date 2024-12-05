<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @author nguyenthanhthuc.2k@gmail.com
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
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'max:20',
                'regex:/^[a-z0-9]+$/',
            ],
            'password_confirmation' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.*' => 'Mật khẩu không hợp lệ.',
            'password_confirmation.*' => 'Mật khẩu không hợp lệ.',
        ];
    }
}
