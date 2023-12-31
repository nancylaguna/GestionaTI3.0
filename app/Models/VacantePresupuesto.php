<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacantePresupuesto extends Model
{
    //use HasFactory;
    protected $connection = 'chavez';

    // Especifica la tabla que utilizará el modelo
    protected $table = 'additional_infos'; // Nombre de la tabla en la BD "chavez"

    // Relación inversa con la tabla positions
    public function vacante()
    {
        return $this->belongsTo(Vacante::class, 'position_id');
    }
}
