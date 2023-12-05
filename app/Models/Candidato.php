<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Candidato extends Model
{
    
    /*use HasFactory;*/
    protected $connection = 'chavez';
    protected $table = 'candidates';


    // Define la relación con la tabla 'languages' a través de la tabla pivote 'candidate_language'
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'candidate_language', 'candidate_id', 'language_id');
    }

    // Define la relación con la tabla 'requirements' a través de la tabla pivote 'candidate_requirement'
    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'candidate_requirement', 'candidate_id', 'requirement_id');
    }

    // Define la relación con la tabla 'candidate_files'
    public function files()
    {
        return $this->hasOne(CandidateFile::class, 'candidate_id', 'id');
    }

    // Define la relación con la tabla 'applications'
    public function applications()
    {
        return $this->hasMany(VacanteApplications::class, 'candidate_id', 'id');
    }
}