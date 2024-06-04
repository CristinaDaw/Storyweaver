<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name'
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
     * Define la relación muchos a muchos con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(){
        return $this->belongsToMany(User::class);
    }
    
}
