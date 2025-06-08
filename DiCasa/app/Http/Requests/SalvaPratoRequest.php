<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvaPratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //podemos apenas deixar se o usuario logado eh admin e está checado
        //return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_prato' => 'required|string|min:3|max:50',
            'descricao' => 'required|string|min:3|max:255',
            'preco_p' => ['required', 'regex:/^\d{1,3}([.,]\d{1,2})?$/'],
            'preco_m' => ['required', 'regex:/^\d{1,3}([.,]\d{1,2})?$/'],
            'preco_g' => ['required', 'regex:/^\d{1,3}([.,]\d{1,2})?$/'],
            'dias' => 'required|array',
            'dias.terca_feira' => 'nullable|boolean',
            'dias.quarta_feira' => 'nullable|boolean',
            'dias.quinta_feira' => 'nullable|boolean',
            'dias.sexta_feira' => 'nullable|boolean',
            'dias.sabado' => 'nullable|boolean',
            'dias.domingo' => 'nullable|boolean',
        ];
    }
    protected function prepareForValidation(): void
    {
        $dias = ['terca_feira', 'quarta_feira', 'quinta_feira', 'sexta_feira', 'sabado', 'domingo'];

        $diasFormatados = [];
        foreach ($dias as $dia) {
            $diasFormatados[$dia] = $this->input("dias.$dia", 0); // 0 se não existir
        }
        $this->merge([
            'dias' => $diasFormatados
        ]);
        $this->merge([
            'preco_p' => str_replace(',', '.', $this->preco_p),
            'preco_m' => str_replace(',', '.', $this->preco_m),
            'preco_g' => str_replace(',', '.', $this->preco_g),
        ]);
    }
}
