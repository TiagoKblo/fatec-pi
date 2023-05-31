<?php

namespace App\Http\Controllers;

use App\Models\Edital;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BuscaController extends Controller
{
    public function buscar(Request $request): JsonResponse
    {
        $filtro = $request->input('filtro');
        $tipo = $request->input('tipo');
        $status = $request->input('status');

        // Realize a busca de acordo com os filtros
        $query = Edital::query();

        if ($filtro === 'numero_edital') {
            $query->where('numero_edital', $tipo);
        } elseif ($filtro === 'tipo_vaga') {
            $query->where('tipo_vaga', $tipo);
        } elseif ($filtro === 'status_edital') {
            $query->where('status', $status);
        } elseif ($filtro === 'carga_horaria') {
            // Lógica de busca por carga horária
            // $query->where('carga_horaria', $tipo);
        }

        $resultados = $query->orderBy('created_at', 'desc')->get();

        // Retorne os resultados como uma resposta JSON
        return response()->json($resultados);
    }
}
