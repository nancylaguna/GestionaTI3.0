<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Vacante;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    public function index1(Request $request)
    {
        // Obtener el valor del parámetro 'idioma' de la solicitud
        $idioma = $request->input('idioma');

        // Obtener las vacantes para el filtro de vacantes
        $vacantes = Vacante::all(); // Asegúrate de importar la clase Vacante

        // Obtener candidatos distintos por nombre con relaciones y paginar los resultados
        $candidatosQuery = Candidato::select(
            DB::raw('MIN(id) as min_id'),
            'name'
        )->with(['languages', 'requirements', 'files'])
            ->groupBy('name')
            ->when($idioma, function ($query) use ($idioma) {
                $query->whereHas('languages', function ($query) use ($idioma) {
                    $query->where('name', $idioma);
                });
            })
            ->orderBy('min_id', 'asc');

        // Aplicar el filtro por vacante
        $vacanteId = $request->input('vacante');
        if ($vacanteId) {
            $candidatosQuery->whereHas('applications.vacante', function ($query) use ($vacanteId) {
                $query->where('id', $vacanteId);
            });
        }

        // Obtener la paginación de los resultados
        $candidatos = $candidatosQuery->paginate(5);

        // Obtener la información completa de cada candidato
        $candidatosFinales = $candidatos->map(function ($candidato) {
            $candidatoCompleto = Candidato::with(['languages', 'requirements', 'files'])
                ->where('name', $candidato->name)
                ->orderBy('id', 'asc')
                ->first();

            return [
                'id' => $candidatoCompleto->id,
                'nombre' => $candidatoCompleto->name,
                'idiomas' => $candidatoCompleto->languages->pluck('name')->unique()->toArray(),
                'requerimientos' => $candidatoCompleto->requirements->pluck('name')->unique()->toArray(),
                'cv_url' => optional($candidatoCompleto->files)->url,
            ];
        });

        // Crear una instancia de LengthAwarePaginator
        $paginador = new LengthAwarePaginator(
            $candidatosFinales->all(),
            $candidatos->total(),
            $candidatos->perPage(),
            $candidatos->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        if ($request->ajax()) {
            return view('candidatos.table', ['candidatos' => $candidatos])->render();
        }

        // Resto del código para el caso de solicitud normal
        return view('candidatos.index', ['candidatos' => $paginador, 'vacantes' => $vacantes]);
    }
}