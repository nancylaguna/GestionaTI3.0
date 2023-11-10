<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vacante;

class VacanteController extends Controller{
    public function index3(){
        // Realizar una consulta que une las tablas y selecciona la información necesaria
        $vacantes = Vacante::select('positions.id', 'positions.title', 'positions.status', 'additional_infos.detail')
            ->leftJoin('additional_infos', function ($join) {
                $join->on('positions.id', '=', 'additional_infos.position_id')
                     ->whereIn('additional_infos.title', ['presupuesto', 'rango de sueldo', 'rate', 'rango máximo de sueldo', 'budget']);
            })
            ->get();
        return view('vacantes.index', compact('vacantes'));
    }
}

    
    