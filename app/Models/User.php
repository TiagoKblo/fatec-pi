<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Os atributos que devem ser ocultados na serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos específicos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Define a relação entre User e Matricula.
     *
     * Um usuário tem uma matrícula.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function matricula()
    {
        return $this->hasOne(Matricula::class);
    }

    /**
     * Define a relação entre User e ManifestoInteresse.
     *
     * Um usuário pode fazer um ou mais manifestos de interesse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function manifestos()
    {
        return $this->belongsToMany(ManifestoInteresse::class);
    }

    /**
     * Verifica se um usuário possui os cargos especificados.
     *
     * @param  User  $usuario
     * @param  string|string[]  $cargos
     * @return bool
     */
    public static function possuiCargos(User $usuario, $cargos)
    {
        $cargos = array_map('strtoupper', (array) $cargos);
        return in_array(strtoupper($usuario->matricula->cargo), $cargos);
    }
}
