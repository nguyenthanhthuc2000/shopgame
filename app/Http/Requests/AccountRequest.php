<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "category_id" => "bail|required|exists:categories,id",
            "class_id" => "bail|required|in:1,2,3",
            "regis_type_id" => "bail|required|in:0,1,2",
            "earring" => "bail|required|in:0,1",
            "server_id" => "bail|required",
            "username" => "bail|required",
            "password" => "bail|required",
            "price_account" => "bail|required|integer",
            "banner" => "bail|required|mimes:png,jpg",
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     * @return string[]
     */
    public function attributes()
    {
        return [
            'category_id' => 'Danh mục',
            'class_id' => 'Hành tinh',
            'regis_type_id' => 'Loại đăng ký',
            'earring' => 'Bông tai',
            'server' => 'Server',
            'username' => 'Tên tài khoản',
            'password' => 'Mật khẩu',
            'price_account' => 'Giá',
            'banner' => 'Ảnh banner',
        ];
    }
}
