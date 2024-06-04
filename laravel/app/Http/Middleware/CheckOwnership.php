<?php

namespace App\Http\Middleware;

use App\Models\Character;
use App\Models\Game;
use Closure;
use Illuminate\Http\Request;

class CheckOwnership
{

        /**
         * Verifica si un usuario es propietario del recurso.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         *
         * @OA\Parameter(
         *     name="game_id",
         *     in="path",
         *     description="ID del juego",
         *     required=true,
         *     @OA\Schema(
         *         type="integer",
         *         format="int64"
         *     )
         * )
         * 
         * @OA\Parameter(
         *     name="id",
         *     in="path",
         *     description="ID del personajer",
         *     required=true,
         *     @OA\Schema(
         *         type="integer",
         *         format="int64"
         *     )
         * )
         *
         * @OA\Response(
         *     response=302,
         *     description="Redirect to the login page"
         * )
         * 
         * @OA\Response(
         *     response=403,
         *     description="Forbidden - User does not have ownership"
         * )
         */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        // Verificar si el usuario es propietario del juego
        if ($request->route()->named('character.create') || $request->route()->named('game.show') || $request->route()->named('game.destroy')) {
            $game_id = $request->route()->parameter('game_id');
            $game = Game::findOrFail($game_id);

            if ($user->roles->first()->id == 1){
                return $next($request);   
            }else if ($game->user_id !== $user->id) {
                return redirect()->route('dashboard')->with('error', 'You are not the owner of this game.');
            }
        }

        // Verificar si el usuario es propietario del personaje
        if ($request->route()->named('character.edit') || 
            $request->route()->named('character.update') || $request->route()->named('destroy.character')) {
            $character_id = $request->route()->parameter('id');
            $character = Character::findOrFail($character_id);
            if ($user->roles->first()->id == 1){
                return $next($request);   
            }else if ($character->game->user_id !== $user->id) {
                return redirect()->route('dashboard')->with('error', 'You are not the owner of this character.');
            }
        }

        return $next($request);
    }
}