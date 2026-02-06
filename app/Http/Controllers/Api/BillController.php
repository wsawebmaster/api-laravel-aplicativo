<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Models\Bill;
use Exception;
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
    public function store(BillRequest $request): JsonResponse
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

    public function update(BillRequest $request, Bill $bill)
    {
        // dd($request);
        // dd($bill);
        // Iniciar a transação
        DB::beginTransaction();

        try {
            // Atualizar a conta no banco de dados
            $bill->update([
                'name' => $request->name,
                'bill_value' => $request->bill_value,
                'due_date' => $request->due_date
            ]);
            // Se tudo estiver correto, confirmar a transação
            DB::commit();

            // Retorna os dados em formato JSON e status 200 (OK)
            return response()->json([
                'status' => true,
                'bill' => $bill,
                'message' => 'Conta atualizada com sucesso!'
            ], 200);
        } catch (Exception $e) {
            // Em caso de erro, reverter a transação
            DB::rollBack();

            // Retorna uma resposta JSON com status de erro e a mensagem de erro
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar a conta: '
            ], 400);
        }
    }
    /**
     * Exclui uma conta existente.
     *
     * Este método exclui uma conta existente do banco de dados e retorna a conta excluída em formato JSON.
     *
     * @param  \App\Models\Bill  $bill O objeto da conta a ser excluída
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Bill $bill): JsonResponse
    {
        try {

            // Excluir o registro do banco de dados
            // dd($bill);
            $bill->delete();

            // Retorna os dados da conta apagada e uma mensagem de sucesso com status 200
            return response()->json([
                'status' => true,
                'bill' => $bill,
                'message' => 'Conta apagada com sucesso!'
            ], 200);
        } catch (Exception $e) {
            // Operação não é concluída com êxito
            DB::rollBack();

            // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => true,
                'message' => 'Conta não apagada!'
            ], 400);
        }
    }
}
