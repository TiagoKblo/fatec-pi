<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_edital',
        'curso',
        'disciplina',
        'turno',
        'horas_aula',
        'dia_da_semana',
        'horario_inicio',
        'horario_fim',
        'prazo',
        'anexo_edital'
    ];
}
