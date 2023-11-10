<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateFile extends Model
{
    //use HasFactory;

    protected $table = 'candidate_files'; // Nombre de la tabla en la base de datos "chavez"

    // Define la relación con el modelo Candidato
    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidate_id', 'id');
    }
}
