<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Admin\BankTransaction;

class BankTransactionRequest extends FormRequest
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
            'email' => [
                'required',
                'exists:users,email',
            ],
            'amount' => [
                'required',
                'numeric',
                'max:5000000',
            ],
            'buyer_vnd' => [
                'required',
                'numeric',
                'max:5000000',
            ],
            'type' => [
                'required',
                Rule::in([BankTransaction::INCREASE_TYPE, BankTransaction::DECREASE_TYPE]),
            ],
            'note' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}