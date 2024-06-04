<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationSummary extends Model{
    use HasFactory;
    protected $table = 'conversation_summary';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id',
        'summary'
    ];

    /**
     * Obtiene el personaje al que pertenece esta conversación.
     *
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
