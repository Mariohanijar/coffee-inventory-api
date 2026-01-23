<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        'id'       => 'required|exists:products,id',
        'name'     => 'string|max:100',
        'category' => 'string',
        'price'    => 'numeric|min:0',
        'quantity' => 'integer|min:0',
    ];
    }

    public function messages(): array
    {
        return [
        'id.exists' => 'O produto informado não existe no nosso estoque.',
        'price.min' => 'O preço não pode ser inferior a zero.',
        ];
    }
}
