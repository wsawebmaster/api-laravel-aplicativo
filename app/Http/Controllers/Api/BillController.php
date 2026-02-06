<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Models\Bill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    /**
     * Retorna uma lista paginada de contas.
     *
     * Este método recupera as contas do banco de dados, ordenadas por ID em ordem decrescente,
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        // Recuperar as contas ordenadas por ID decrescente com paginação
        $bills = Bill::orderBy('id', 'desc')->paginate(40);

        // Retornar os dados em formato JSON
        return response()->json([
            'status' => true,
            'bills' => $bills,
        ], 200);
    }

    /**
     * Exibe os detalhes de uma conta específica.
     *
     * Este método retorna os detalhes de uma conta com base no ID fornecido.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Bill $bill): JsonResponse
    {
        return response()->json([
            'status' => true,
            'bill' => $bill,
        ], 200);
    }

    /**
     * Armazena uma nova conta no banco de dados.
     *
     * Este método cria uma nova conta com os dados fornecidos na solicitação.
     *
     * @param  \App\Http\Requests\BillRequest  $request Os dados da nova conta a ser criada, validados pelo BillRequest.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BillRequest $request) : JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        try {
            // Cadastrar a conta no banco de dados
            $bill = Bill::create([
                'name' => $request->name,
                'bill_value' => $request->bill_value,
                'due_date' => $request->due_date
            ]);
            // Se tudo estiver correto, confirmar a transação
            DB::commit();

            // Retorna os dados em formato JSON e status 201 (Created)
            return response()->json([
                'status' => true,
                'bill' => $bill,
                'message' => 'Conta criada com sucesso!'
            ], 201);
        } catch (\Exception $e) {
            // Em caso de erro, reverter a transação
            DB::rollBack();

            // Retorna uma resposta JSON com status de erro e a mensagem de erro
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar a conta: '
            ], 400);
        }
    }
}
