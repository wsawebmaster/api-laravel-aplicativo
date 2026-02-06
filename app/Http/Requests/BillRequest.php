<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class BillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Manipular falha de validação para retornar uma resposta JSON personalizada.
     * @param \\Illuminate\\Contracts\\Validation\\Validator $validator
     * @throws \\Illuminate\\Http\\Exceptions\\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Retorna as regras de validação para os campos de contas.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'bill_value' => 'required|decimal:2',
            'due_date' => 'required|date',
        ];
    }

    /**
     * Retorna as mensagens de erro personalizadas para as regras de validação.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório.',
            'bill_value.required' => 'Campo valor da conta é obrigatório.',
            'bill_value.decimal' => 'Campo valor da conta deve ser um número decimal com até 2 casas decimais.',
            'due_date.required' => 'Campo data de vencimento é obrigatório.',
            'due_date.date' => 'Campo data de vencimento deve ser uma data válida.',
        ];
    }
}
