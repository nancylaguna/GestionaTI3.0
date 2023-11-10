<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model{
    //use HasFactory;
    protected $connection = 'chavez';
    protected $table = 'positions';

    // Relación con la tabla additional_infos
    public function presupuesto(){
        return $this->hasOne(VacantePresupuesto::class, 'position_id')
            ->where(function ($query) {
            $query->where('title', 'presupuesto')
                ->orWhere('title', 'rango de sueldo')
                ->orWhere('title', 'rate')
                ->orWhere('title', 'rango máximo de sueldo')
                ->orWhere('title', 'budget');
        });
    }
}
