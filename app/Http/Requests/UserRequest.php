<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
    protected function failedValidationUser(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422)); // O código de status HTTP 422 significa "Unprocessable Entity" (Entidade Não Processável). Esse código é usado quando o servidor entende a requisição do cliente, mas não pode processá-la devido a erros de validação no lado do servidor.
    }

    /**
     * Retorna as regras de validação para os campos do usuário.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Recuperar o id do usuário enviado na URL
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required_if:password,!=,null|min:6'
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
            'email.required' => 'Campo e-mail é obrigatório.',
            'email.email' => 'Campo e-mail deve ser um e-mail válido.',
            'email.unique' => 'O e-mail já está em uso.',
            'password.required_if' => 'Campo senha é obrigatório!',
            'password.min' => 'Campo senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
