<?php

namespace App\Models;

use Carbon\Carbon;
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
        'anexo_edital',
        'status'
    ];

    public function getDiaDaSemana()
    {
        return Carbon::parse($this->dia_da_semana)->locale('pt_BR')->dayName;
    }

    public function getHorarioInicio()
    {
        return Carbon::parse($this->horario_inicio)->format('H:i');
    }

    public function getHorarioFim()
    {
        return Carbon::parse($this->horario_fim)->format('H:i');
    }

    public function save(array $options = []) {
        $this->descricao = "";
        parent::save($options);
    }
}

