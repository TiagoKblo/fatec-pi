<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    // nome da tabela
    protected $table = 'matriculas';

    // Uma matricula pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
