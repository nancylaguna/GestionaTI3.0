<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
   // use HasFactory;
   protected $connection = 'chavez';

    protected $table = 'requirements'; // Nombre de la tabla en la base de datos "chavez"

    // Define la relación con los candidatos
    public function candidates()
    {
        return $this->belongsToMany(Candidato::class, 'candidate_requirement', 'requirement_id', 'candidate_id');
    }
}