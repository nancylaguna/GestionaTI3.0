<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $connection = 'mexico'; // Nombre de la conexión a la base de datos

    protected $table = 'estados'; // Nombre de la tabla en la base de datos

    public function municipio()
    {
        return $this->hasMany(Municipio::class, 'estado_id', 'id');
    }
}
