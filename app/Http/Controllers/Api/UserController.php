<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Retorna uma lista paginada de usuários.
     *
     * Este método recupera uma lista paginada de usuários do banco de dados
     * e a retorna como uma resposta JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        // Recupera os usuários do banco de dados, ordenados pelo id em ordem decrescente, paginados
        $users = User::orderBy('id', 'desc')->paginate(40);

        // Retorna os usuários recuperados como uma resposta JSON
        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }
    /**
     * Exibe os detalhes de um usuário específico.
     *
     * Este método retorna os detalhes de um usuário específico em formato JSON com base no ID fornecido.
     *
     * @param  \App\Models\User  $user O objeto do usuário a ser exibido, injetado automaticamente pelo Laravel com base no ID da rota.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }

    /**
     * Armazena um novo usuário no banco de dados.
     *
     * Este método cria um novo usuário com os dados fornecidos na solicitação.
     *
     * @param  \App\Http\Requests\UserRequest  $request Os dados do novo usuário a ser criado, validados pelo UserRequest.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(\App\Http\Requests\UserRequest $request): JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        try {
            // Criar um novo usuário com os dados validados
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            // Se tudo estiver correto, confirmar a transação
            DB::commit();

            // Retorna os dados do usuário criado em formato JSON e status 201 (Created)
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário cadastrado com sucesso.',
            ], 201);
        } catch (\Exception $e) {
            // Em caso de erro, desfazer a transação
            DB::rollBack();

            // Retorna uma resposta JSON com o erro e status 500 (Internal Server Error)
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário: '
            ], 400);
        }
    }
}
