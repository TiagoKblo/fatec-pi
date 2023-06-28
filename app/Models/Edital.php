<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    use HasFactory;

    protected $table = 'editais';

    protected $fillable = [
        'numero_edital', // Número do edital
        'curso', // Curso
        'disciplina', // Disciplina
        'turno', // Turno
        'horas_aula', // Horas de aula
        'dia_da_semana', // Dia da semana
        'horario_inicio', // Horário de início
        'horario_fim', // Horário de término
        'prazo', // Prazo
        'anexo_edital', // Anexo do edital
        'status' // Status
    ];

    protected $casts = [
        'dia_da_semana' => 'integer', // O campo 'dia_da_semana' será convertido para o tipo 'integer'
    ];

    protected $attributes = [
        'status' => 'A', // O status padrão é 'A' (Aberto)
        'anexo_edital' => 'sem-anexo.pdf', // O anexo padrão é 'sem-anexo.pdf'
    ];

    /**
     * Obtém o dia da semana formatado em português.
     *
     * @return string
     */
    public function getDiaDaSemana()
    {
        return Carbon::parse($this->attributes['dia_da_semana'])->locale('pt_BR')->dayName;
    }

    /**
     * Obtém o horário de início formatado.
     *
     * @return string
     */
    public function getHorarioInicio()
    {
        return Carbon::parse(
            $this->attributes['horario_inicio']
        )->format('H:i');
    }

    /**
     * Obtém o horário de término formatado.
     *
     * @return string
     */
    public function getHorarioFim()
    {
        return Carbon::parse(
            $this->attributes['horario_fim']
        )->format('H:i');
    }

    /**
     * Obtém o prazo em letras maiúsculas.
     *
     * @return string
     */
    public function getPrazo()
    {
        return strtoupper($this->attributes['prazo']);
    }

    /**
     * Obtém as opções de status como um array.
     *
     * @return array
     */
    public function getStatusOptions(): array
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

    /**
     * Obtém o nome do status com base no valor do campo 'status'.
     *
     * @return string
     */
    public function getStatusName(): string
    {
        $statusOptions = $this->getStatusOptions();

        return $statusOptions[$this->attributes['status']];
    }
}
