<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vacante;

class VacanteController extends Controller{
    // Dentro de la función index3 en VacanteController
    public function index3(){
        $vacantes = Vacante::select(
            'positions.id',
            'positions.title',
            'positions.status',
            'additional_infos.detail',
            DB::raw('COUNT(DISTINCT applications.candidate_id) as num_candidatos'),
            DB::raw('COUNT(DISTINCT CASE WHEN candidate_requirement.candidate_id IS NOT NULL THEN applications.candidate_id END) as candidatos_cumplen_req')
        )
        ->leftJoin('additional_infos', function ($join) {
            $join->on('positions.id', '=', 'additional_infos.position_id')
                ->whereIn('additional_infos.title', ['presupuesto', 'rango de sueldo', 'rate', 'rango máximo de sueldo', 'budget']);
        })
        ->leftJoin('applications', 'positions.id', '=', 'applications.position_id')
        ->leftJoin('candidate_requirement', function ($join) {
            $join->on('applications.candidate_id', '=', 'candidate_requirement.candidate_id');
        })
        ->groupBy('positions.id', 'positions.title', 'positions.status', 'additional_infos.detail')
        ->get();

        return view('vacantes.index', compact('vacantes'));
    }

}

