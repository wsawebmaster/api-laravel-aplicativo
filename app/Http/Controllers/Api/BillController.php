<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\JsonResponse;

class BillController extends Controller
{
    /**
     * Retorna uma lista paginada de contas.
     *
     * Este método recupera as contas do banco de dados, ordenadas por ID em ordem decrescente,
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse
    {
        // Recuperar as contas ordenadas por ID decrescente com paginação
        $bills = Bill::orderBy('id', 'desc')->paginate(1);

        // Retornar os dados em formato JSON
        return response()->json([
            'status' => true,
            'bills' => $bills,
        ], 200);
    }
}
