<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    //use HasFactory;

    // Establecer conexión a la base de datos 'chavez'
    protected $connection = 'chavez';

    // Especifica la tabla que utilizará el modelo
    protected $table = 'positions';

    // Relación con la tabla additional_infos
    public function presupuesto()
    {
        return $this->hasOne(VacantePresupuesto::class, 'position_id')
            ->where(function ($query) {
                // Se filtran las opciones que existen en la BD para $salario
                $query->where('title', 'presupuesto')
                    ->orWhere('title', 'rango de sueldo')
                    ->orWhere('title', 'rate')
                    ->orWhere('title', 'rango máximo de sueldo')
                    ->orWhere('title', 'budget');
            });
    }
}
