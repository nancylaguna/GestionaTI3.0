<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $connection = 'mexico'; // Asegúrate de que esté apuntando a la conexión correcta

    protected $table = 'municipios'; // Nombre de la tabla en la base de datos

public function candidatos()
{
    return $this->hasMany(Candidato::class, 'municipio_id', 'id');
}
public function estado()
{
    return $this->belongsTo(Estado::class, 'id_estado', 'id');
}



}
