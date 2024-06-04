<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'status',
        'context',
        'img_register'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function character()
    {
        return $this->hasOne(Character::class);
    }

    public function conversation_summary()
    {
        return $this->hasOne(ConversationSummary::class);
    }


}
