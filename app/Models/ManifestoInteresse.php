<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestoInteresse extends Model
{
    use HasFactory;


    // UM manifesto de interesse pode ser feito por um ou mais usuários
    // Um usuário pode fazer um ou mais manifestos de interesse
    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id')->select(['id', 'name', 'email', 'created_at']);
    }

}
