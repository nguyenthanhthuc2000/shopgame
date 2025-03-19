<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\CardTransaction;

class PostCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'telco' => [
                'required',
                Rule::in(array_keys(CardTransaction::CARD_TYPES)),
            ],
            'declared_value' => [
                'required',
                'numeric',
            ],
            'code' => [
                'required',
                'max:100',
            ],
            'serial' => [
                'required',
                'max:100',
            ],
            'g-recaptcha-response' => [
                'required',
                'captcha',
            ],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'telco.required' => 'Nhà mạng không được để trống.',
            'telco.in' => 'Nhà mạng không hợp lệ.',
            'declared_value.required' => 'Giá trị khai báo là bắt buộc.',
            'declared_value.numeric' => 'Giá trị khai báo phải là số.',
            'code.required' => 'Mã thẻ không được để trống.',
            'serial.required' => 'Số serial không được để trống.',
            'code.max' => 'Mã thẻ không được vượt quá 100 ký tự.',
            'serial.max' => 'Số serial không được vượt quá 100 ký tự.',
        ];
    }
}
