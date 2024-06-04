<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;
    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'nickname',
        'email',
        'password'
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Obtiene los juegos asociados con este usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    /**
     * Obtiene los roles asociados con este usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
