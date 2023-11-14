<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacanteApplications extends Model
{
    //use HasFactory;
    protected $table = 'applications'; // Nombre de la tabla en la base de datos "chavez"
    // Relación inversa con la tabla positions
    public function vacante(){
        return $this->belongsTo(Vacante::class, 'position_id');
    }
}