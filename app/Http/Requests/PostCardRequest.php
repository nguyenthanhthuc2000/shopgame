<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CardTransaction;

class PostCardRequest extends FormRequest
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
                'numeric',
            ],
            'serial' => [
                'required',
                'numeric',
            ],
        ];
    }
}
