<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function index2()
    {
        // Lógica para mostrar la vista de gráficas
        return view('graficas.index');
    }

    public function getChartData()
    {
        // Obtener datos para el gráfico desde la base de datos
        $data = DB::table('candidate_language')
            ->join('languages', 'candidate_language.language_id', '=', 'languages.id')
            ->select('languages.name as language', DB::raw('COUNT(*) as total'))
            ->groupBy('languages.name')
            ->get();

        return response()->json($data);
    }
}

