<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatoController extends Controller
{
    public function index1()
{

    // Utiliza Eloquent para obtener los candidatos con relaciones y evita duplicados basados en el nombre
    $candidatos = Candidato::with(['languages', 'requirements', 'files'])
        ->orderBy('id', 'asc') // Ordena por ID en orden ascendente para obtener el primer ID asignado
        ->get();

    $candidatosAgrupados = [];

    foreach ($candidatos as $candidato) {
        $candidatoNombre = $candidato->name;

        // Agrupa los candidatos por nombre
        $candidatosAgrupados[$candidatoNombre][] = [
            'id' => $candidato->id,
            'nombre' => $candidatoNombre,
            'idiomas' => $candidato->languages->pluck('name')->unique()->toArray(),
            'requerimientos' => $candidato->requirements->pluck('name')->unique()->toArray(),
            'cv_url' => $candidato->files ? $candidato->files->url : null,
        ];
    }

    // Selecciona el primer candidato de cada grupo
    $candidatosFinales = [];
    foreach ($candidatosAgrupados as $nombre => $candidatosGrupo) {
        $primerCandidato = reset($candidatosGrupo);
        $candidatosFinales[$nombre] = $primerCandidato;
    }

    return view('candidatos.index', ['candidatos' => $candidatosFinales]);
}


}
