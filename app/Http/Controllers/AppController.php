<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AppController extends Controller
{
   
    
    public function index1()
    {
        $candidatos = DB::connection('chavez')->table('candidates')
            ->join('candidate_language', 'candidates.id', '=', 'candidate_language.candidate_id')
            ->join('languages', 'candidate_language.language_id', '=', 'languages.id')
            ->join('candidate_requirement', 'candidates.id', '=', 'candidate_requirement.candidate_id')
            ->join('requirements', 'candidate_requirement.requirement_id', '=', 'requirements.id')
            ->select('candidates.id', 'candidates.name', 'candidates.email', 'languages.name as language_name', 'requirements.name as requeriment_name')
            ->get();
    
        // Ahora, obtén el URL del CV de cada candidato
        foreach ($candidatos as $candidato) {
            $cvUrl = DB::connection('chavez')->table('candidate_files')
                ->where('candidate_id', $candidato->id)
                ->value('url');
    
            $candidato->cv_url = $cvUrl;
        }
    
        $candidatosAgrupados = [];
    
        foreach ($candidatos as $candidato) {
            $candidatoId = $candidato->id;
            $candidatoNombre = $candidato->name;
            $idiomas = [$candidato->language_name];
            $requerimientos = [$candidato->requeriment_name];
            $cvUrl = $candidato->cv_url;
    
            if (isset($candidatosAgrupados[$candidatoId])) {
                $idiomas = array_unique(array_merge($candidatosAgrupados[$candidatoId]['idiomas'], $idiomas));
                $requerimientos = array_unique(array_merge($candidatosAgrupados[$candidatoId]['requerimientos'], $requerimientos));
            }
    
            $candidatosAgrupados[$candidatoId] = [
                'nombre' => $candidatoNombre,
                'idiomas' => $idiomas,
                'requerimientos' => $requerimientos,
                'cv_url' => $cvUrl,
            ];
        }
    
        return view('candidatos.index', ['candidatos' => $candidatosAgrupados]);
    }
    
    


    



    public function index2(){
        return view('graficas.index');}

    public function index3(){
        return view('vacantes.index');}
}
