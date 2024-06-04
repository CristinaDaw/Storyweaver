<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use App\Models\ConversationSummary;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function getChatHistory($game_id)
    {
        // Consultar la base de datos para obtener el historial del chat para el juego dado
        $chatHistory = ChatHistory::where('game_id', $game_id)->get();

        // Devolver los resultados como JSON
        return response()->json($chatHistory);
    }

    public function persistContext(Request $request)
    {
        // Validar la solicitud, asegurándose de que se envíe el contexto
        $request->validate([
            'context' => 'required|string',
        ]);

        $context = $request->input('context');

        $game = Game::findOrFail($request->input('game_id'));
        if ($game) {
            $game->context = $context;
            $game->save();
        }

        return response()->json(['context' => $game->context]);
    }

    public function sendMessage(Request $request): \Illuminate\Http\JsonResponse
    {
        $character = $request->input('character');
        $message = $request->input('message');
        $context = $request->input('context');
        $game_id = $request->input('game_id');

        $chat_history = $this->getChatHistory($game_id);

        $response = Http::post('http://127.0.0.1:5000/api/chat', [
            'character' => $character,
            'message' => $message,
            'context' => $context,
            'history' => $chat_history,
        ]);

        $responseData = $response->json();

        $chatHistory = new ChatHistory();
        $chatHistory->game_id = $game_id;
        $chatHistory->message = 'Player: ' . $message;
        $chatHistory->response = 'Master AI: ' . $responseData['response'];

        if ($chatHistory->save()) {
            Log::debug('El objeto Chat History se guardó correctamente.');
        } else {
            Log::error('Hubo un problema al guardar el objeto Chat History.');
        }

        return response()->json([
            'response' => $responseData['response'] ?? null,
            'summary' => $responseData['summary'] ?? null,
            'imageContainerId' => null
        ]);
    }

    public function generateImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $gameId = $request->input('game_id');
        $chat_history = ChatHistory::where('game_id', $gameId)->latest()->first();
        Log::debug('ChatHistory' . $chat_history);

        $response_text = $request->input('response_text');

        $imageResponse = Http::post('http://127.0.0.1:5000/api/image', [
            'response_text' => $response_text,
        ]);

        $imageResponseData = $imageResponse->json();
        Log::debug('ResponseDataIMAGE:' . $imageResponseData['image_url']);

        $chat_history->image_url = $imageResponseData['image_url'];

        if ($chat_history->save()) {
            Log::debug('El objeto Chat History se guardó correctamente.');
        } else {
            Log::error('Hubo un problema al guardar el objeto Chat History.');
        }

        if (is_string($imageResponseData['image_url']) && !empty($imageResponseData['image_url'])) {
            Log::debug('URL de imagen recibida:' . $imageResponseData['image_url']);
        } else {
            Log::debug("No se proporcionó una URL de imagen en la respuesta. Usando la URL predeterminada.");
            $imageResponseData['image_url'] = 'https://placehold.co/600x400';
        }

        return response()->json([
            'image_url' => $imageResponseData['image_url']
        ]);
    }
}
