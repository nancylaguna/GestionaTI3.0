<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacantePresupuesto extends Model{
    //use HasFactory;
    protected $table = 'additional_infos'; // Nombre de la tabla en la base de datos "chavez"
    // Relación inversa con la tabla positions
    public function vacante(){
        return $this->belongsTo(Vacante::class, 'position_id');
    }
}
