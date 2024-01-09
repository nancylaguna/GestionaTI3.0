<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Language;
use App\Models\Vacante;
use App\Models\VacanteApplications;

class GraficaController extends Controller{
    /**
     * Muestra la vista de la página de gráficos con datos filtrados por idioma.
     */
    public function index2(Request $request, $selectedLanguages = [], $selectedVacante = null/*, $selectedSkills = []*/)
    {
        // Obtener el idioma seleccionado del filtro
        $selectedLanguages = $request->input('idiomas') ?? [];
        $selectedVacante = (array) $request->input('vacante') ?? [];
        //$selectedSkills = $request->input('skills') ?? [];

        // Si no hay idiomas seleccionados, predeterminadamente seleccionar ambos
        if (empty($selectedLanguages)) {
            $selectedLanguages = ['espanol', 'english'];
        }

        // Si no se ha seleccionado ninguna vacante, establecer las vacantes predeterminadas
        if (empty($selectedVacante)) {
            $defaultVacantes = ['Empleos remotos TI', 'Desarrollador Full Stack (Laravel-Vue)', 'Full stack Laravel (PHP + Vue 3)', 'Java + React Senior Developer'];
            $selectedVacante = Vacante::whereIn('title', $defaultVacantes)->pluck('id')->toArray();
        }

        // Obtén las habilidades de la tabla c3_puesto
        //$skills = \DB::connection('aldo')->table('c3_puesto')->pluck('skill')->toArray();


         // Obtener datos de candidatos según la selección del filtro de idiomas
        $dataIdiomas = $this->getData($selectedLanguages);

        // Obtener la lista de vacantes y el conteo de candidatos por vacante
        $vacantes = Vacante::all();
        $dataVacantes = $this->getDataVacantes($selectedVacante);

        // Obtener datos de candidatos según la selección del filtro de habilidades
        //$dataSkills = $this->getDataSkills($selectedSkills);

        // Pasar los datos a la vista
    return view('graficas.index', compact('dataIdiomas', 'selectedLanguages', 'vacantes', 'dataVacantes', 'selectedVacante'/*, 'dataSkills', 'selectedSkills', 'skills'*/));
    }

    /**
     * Esta función obtiene datos relacionados con las habilidades seleccionadas.
     *
     * @param array $selectedSkills Un array de habilidades seleccionadas.
     * @return array Un array asociativo donde las claves son las habilidades y los valores son los salarios promedio.
     */
    /*private function getDataSkills($selectedSkills)
    {
        // Inicializa un array para almacenar los datos de habilidades.
        $dataSkills = [];
        
        // Itera sobre las habilidades seleccionadas.
        foreach ($selectedSkills as $skill) {
            // Realiza la consulta en la base de datos "aldo".
            $query = \DB::connection('aldo')->table('informacion_profesional')
                ->join('c3_puesto', 'informacion_profesional.puesto', '=', 'c3_puesto.id')
                ->where('c3_puesto.skill', $skill);
        
            // Calcula el promedio de sueldo_min y sueldo_max.
            $averageSalary = $query->avg(\DB::raw('(sueldo_min + sueldo_max) / 2'));
        
            // Almacena el resultado en el array de datos de habilidades.
            $dataSkills[$skill] = $averageSalary;
        }
        
        // Devuelve el array de datos de habilidades.
        return $dataSkills;
    }*/
    
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
