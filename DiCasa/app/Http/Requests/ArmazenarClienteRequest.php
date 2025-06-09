<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArmazenarClienteRequest extends FormRequest
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
            'nome' => 'required|string|max:50',

            // Telefones: array de strings formatadas
            'telefones' => 'required|array|min:1',
            'telefones.*' => [
                'required',
                'string',
                'max:14',
            ],

            // Endereços: array de objetos
            'enderecos' => 'required|array|min:1',
            'enderecos.*.logradouro' => 'required|string|max:150',
            'enderecos.*.bairro' => 'nullable|string|max:50',
            'enderecos.*.complemento' => 'nullable|string|max:30',
        ];
    }
}
