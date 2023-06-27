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

    public function getPrazo()
    {
        return strtoupper($this->prazo);
    }

    public function save(array $options = []) {
        $this->descricao = "";
        parent::save($options);
    }

    public function getStatusOptions() : array
    {
        return [
            'A' => 'Aberto',
            'F' => 'Finalizado',
            'C' => 'Cancelado',
            'CA' => 'Cadastrado',
            'P' => 'Publicado',
            'E' => 'Errata',
            'CN' => 'Cancelado (Sem Inscrições)',
            'RI' => 'Recebendo Inscrições',
            'EA' => 'Em Análise',
            'DP' => 'Deferimentos Publicados',
            'FI' => 'Finalizado sem Inscritos',
            'RPP' => 'Resultado Parcial Publicado',
            'RR' => 'Recebendo Recursos',
            'AR' => 'Analisando Recursos',
            'RP' => 'Resultado Publicado',
        ];
    }

    public function getStatusName() : string
    {
        $statusOptions = $this->getStatusOptions();

        return $statusOptions[$this->status];
    }

}

