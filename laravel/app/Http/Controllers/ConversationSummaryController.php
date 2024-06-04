<?php

namespace App\Http\Controllers;

use App\Models\ConversationSummary;
use Illuminate\Http\Request;

class ConversationSummaryController extends Controller
{
    public function get ($game_id): \Illuminate\Http\JsonResponse
    {
        // Consultar la base de datos para obtener el summary del chat para el juego dado
        $chatSummary = ConversationSummary::where('game_id', $game_id)->get();

        // Devolver los resultados como JSON
        return response()->json($chatSummary);
    }

    public function store(Request $request, $game_id): \Illuminate\Http\JsonResponse
    {
        // Validar la entrada
        $request->validate([
            'summary' => 'required|string', // Ejemplo de validación básica, ajusta según tus necesidades
        ]);

        $new_summary = $request->input('summary');

        // Encontrar o crear un nuevo resumen de la conversación
        $game_summary = ConversationSummary::where('game_id', $game_id)->first();
        if ($game_summary) {
            // Actualizar el resumen existente
            $game_summary->summary = $new_summary;
            $game_summary->save();
            return response()->json(['result' => 'Conversation Summary properly updated.']);
        } else {
            // Crear un nuevo resumen si no existe
            $game_summary = new ConversationSummary();
            $game_summary->game_id = $game_id;
            $game_summary->summary = $new_summary;
            $game_summary->save();
            return response()->json(['result' => 'Conversation Summary created and stored.']);
        }
    }
}

