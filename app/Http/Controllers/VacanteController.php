<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vacante;
use Illuminate\Pagination\Paginator;

class VacanteController extends Controller
{
    public function index3(Request $request)
    {
        // Obtener el valor del filtro de estatus desde la solicitud HTTP
        $filtroEstatus = $request->input('filtro_estatus');
    
        // Construcción de la consulta para obtener información de vacantes
        $vacantes = Vacante::select(
            'positions.id',
            'positions.title',
            'positions.status',
            'additional_infos.detail',
            // Utiliza SQL raw para contar los candidatos totales y los candidatos que cumplen requisitos de cada vacante
            DB::raw('COUNT(DISTINCT applications.candidate_id) as num_candidatos'),
            DB::raw('COUNT(DISTINCT CASE WHEN candidate_requirement.candidate_id IS NOT NULL THEN applications.candidate_id END) as candidatos_cumplen_req')
        )
            // Realiza un left join con la tabla additional_infos para obtener información de esa tabla
            ->leftJoin('additional_infos', function ($join) {
                $join->on('positions.id', '=', 'additional_infos.position_id')
                    ->whereIn('additional_infos.title', ['presupuesto', 'rango de sueldo', 'rate', 'rango máximo de sueldo', 'budget']);
            })
            // Realiza un left join con la tabla applications para contar candidatos
            ->leftJoin('applications', 'positions.id', '=', 'applications.position_id')
            // Realiza un left join con la tabla candidate_requirement para contar candidatos que cumplen requisitos
            ->leftJoin('candidate_requirement', function ($join) {
                $join->on('applications.candidate_id', '=', 'candidate_requirement.candidate_id');
            });
    
        // Aplica el filtro de estatus si se seleccionó
        


        if ($filtroEstatus && $filtroEstatus != 'todos') {
            if ($filtroEstatus == '1') {
                // Muestra vacantes con estado 1 y 4 cuando se selecciona "Abierto"
                $vacantes->whereIn('positions.status', [1, 4]);
            } else {
                // Aplica el filtro de estatus normalmente para otros casos
                $vacantes->where('positions.status', $filtroEstatus);
            }
        }
    
        // Agrupa los resultados por ciertos campos y se aplica la paginacion
        $vacantes = $vacantes
            ->groupBy('positions.id', 'positions.title', 'positions.status', 'additional_infos.detail')
            ->paginate(5);
    
        // Ajusta la paginación 
        $vacantes->onEachSide(1);
    
        // Devuelve la vista 'vacantes.index' con los resultados y el filtro de estatus
        return view('vacantes.index', compact('vacantes', 'filtroEstatus'));
    }
}
  