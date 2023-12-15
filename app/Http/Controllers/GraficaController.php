<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Language;
use App\Models\Vacante;
use App\Models\VacanteApplications;

class GraficaController extends Controller
{
    /**
     * Muestra la vista de la página de gráficos con datos filtrados por idioma.
     */
    public function index2(Request $request, $selectedLanguages = [], $selectedVacante = null)
{
    // Obtener el idioma seleccionado del filtro
    $selectedLanguages = $request->input('idiomas') ?? [];
    $selectedVacante = (array) $request->input('vacante') ?? [];

    // Si no hay idiomas seleccionados, predeterminadamente seleccionar ambos
    if (empty($selectedLanguages)) {
        $selectedLanguages = ['espanol', 'english'];
    }

    // Si no se ha seleccionado ninguna vacante, establecer las vacantes predeterminadas
    if (empty($selectedVacante)) {
        $defaultVacantes = ['Empleos remotos TI', 'Desarrollador Full Stack (Laravel-Vue)', 'Full stack Laravel (PHP + Vue 3)', 'Java + React Senior Developer'];
        $selectedVacante = Vacante::whereIn('title', $defaultVacantes)->pluck('id')->toArray();
    }

    // Obtener datos de candidatos según la selección del filtro de idiomas
    $dataIdiomas = $this->getData($selectedLanguages);

    // Obtener la lista de vacantes y el conteo de candidatos por vacante
    $vacantes = Vacante::all();
    $dataVacantes = $this->getDataVacantes($selectedVacante);

    // Pasar los datos a la vista
    return view('graficas.index', compact('dataIdiomas', 'selectedLanguages', 'vacantes', 'dataVacantes', 'selectedVacante'));
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

    /**
     * Obtiene los datos de candidatos según la vacante seleccionada.
     */
    private function getDataVacantes($selectedVacante)
    {
        $dataVacantes = ['titles' => [], 'data' => []];

        foreach ($selectedVacante as $vacanteId) {
            $query = VacanteApplications::query();
            $query->where('position_id', $vacanteId);
            $count = $query->count();
            
            // Obtener el título de la vacante por ID
            $dataVacantes['titles'][] = Vacante::where('id', $vacanteId)->value('title');
            $dataVacantes['data'][] = $count;
        }

        return $dataVacantes;
    }
}
