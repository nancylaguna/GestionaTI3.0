<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacanteApplications extends Model
{
    //use HasFactory;

    // Especifica la tabla que utilizará el modelo
    protected $connection = 'chavez';

    protected $table = 'applications'; // Nombre de la tabla en la BD "chavez"

    // Relación inversa con la tabla positions
    public function vacante()
    {
        return $this->belongsTo(Vacante::class, 'position_id');
    }
}
