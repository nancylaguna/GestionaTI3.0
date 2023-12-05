<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
   // use HasFactory;
   protected $connection = 'chavez';

   protected $table = 'languages'; // Nombre de la tabla en la base de datos "chavez"

    // Define la relación con los candidatos
    public function candidates()
    {
        return $this->belongsToMany(Candidato::class, 'candidate_language', 'language_id', 'candidate_id');
    }
}