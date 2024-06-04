<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model{
    use HasFactory;
    protected $table = 'chat_history';

    /**
    * Los atributos que se pueden asignar en masa.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'game_id',
        'message',
        'response',
        'image_url'
    ];

    /**
    * Obtiene el personaje al que pertenece esta conversación.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
