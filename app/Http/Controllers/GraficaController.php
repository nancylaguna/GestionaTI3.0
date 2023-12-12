<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Language;

class GraficaController extends Controller
{
    /**
     * Muestra la vista de la página de gráficos con datos filtrados por idioma.
     */
    public function index2(Request $request)
    {
        // Obtener el idioma seleccionado del filtro
        $selectedLanguages = $request->input('idiomas');
    
        // Verificar si $selectedLanguages es nulo y convertirlo en un array vacío si es necesario
        $selectedLanguages = $selectedLanguages ?? [];
    
        // Obtener datos según la selección del filtro
        $data = $this->getData($selectedLanguages);
    
        // Pasar los datos a la vista
        return view('graficas.index', compact('data', 'selectedLanguages'));
    }
    
    /**
     * Obtiene los datos de candidatos según los idiomas seleccionados.
     */
    private function getData($selectedLanguages)
    {
        $data = [];
    
        foreach ($selectedLanguages as $language) {
            $query = Candidato::query();
            $query->whereHas('languages', function ($query) use ($language) {
                $query->where('name', $language);
            });
            $data[$language] = $query->count();
        }
    
        return $data;
    }
}
