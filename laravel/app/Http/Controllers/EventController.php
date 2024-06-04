<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDO;

class EventController extends Controller
{
    
    /**
     * Almacena un evento inicial para un personaje dado.
     *
     * @param int $character_id ID del personaje para el cual se almacenará el evento inicial
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Post(
     *      path="/api/character/{character_id}/initial-event",
     *      operationId="storeInitialEvent",
     *      tags={"Character"},
     *      summary="Almacena un evento inicial para un personaje",
     *      description="Crea un registro de evento inicial en la base de datos para un personaje específico.",
     *      @OA\Parameter(
     *          name="character_id",
     *          in="path",
     *          description="ID del personaje",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona a la página de inicio del dashboard",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="string",
     *                  example="Character created successfully"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Personaje no encontrado",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Personaje no encontrado"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */
    
    public function storeInitialEvent($character_id)
    {
        $character = Character::findOrFail($character_id);

        DB::table('events')->insert([
            'character_id' => $character->id,
            'description' => 'La historia de ' . $character->name .' the ' .$character->class .' comienza...',
            'created_at' => now()->subDays(30), // Crear una fecha mucho más antigua
            'updated_at' => now()->subDays(30) 
        ]);

        return Redirect::route('dashboard')
        ->with('success', 'Character created successfully');    
    }


    /**
     * Almacena un evento de finalización para un personaje dado.
     *
     * @param int $character_id ID del personaje para el cual se almacenará el evento de finalización
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Post(
     *      path="/api/character/{character_id}/ending-event",
     *      operationId="storeEndingEvent",
     *      tags={"Character"},
     *      summary="Almacena un evento de finalización para un personaje",
     *      description="Crea un registro de evento de finalización en la base de datos para un personaje específico.",
     *      @OA\Parameter(
     *          name="character_id",
     *          in="path",
     *          description="ID del personaje",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona a la página de inicio del dashboard",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="string",
     *                  example="Game finished successfully"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Personaje no encontrado",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Personaje no encontrado"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function storeEndingEvent ($game_id)
    {
        $game = Game::findOrFail($game_id);
        $character = $game->character;

        DB::table('events')->insert([
            'character_id' => $character->id,
            'description' => 'La aventura de ' . $character->name .' the ' .$character->class .' ha llegado a su fin...',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if(auth()->check() && auth()->user()->roles->first()->id == 1){
            return Redirect::route('dashboard.admin')
        ->with('success', 'Game finished successfully'); 
        } else {
            return Redirect::route('dashboard')
        ->with('success', 'Game finished successfully'); 
        }
           
    }


    /**
     * @OA\Get(
     *      path="/events/latest",
     *      operationId="indexLatest",
     *      tags={"Events"},
     *      summary="Obtener los últimos eventos",
     *      description="Obtiene los últimos eventos ordenados por fecha para cada personaje.",
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Error del servidor"
     *      )
     * )
     */

    public function indexLatest()
    {
        // Obtenemos los últimos eventos ordenados por fecha
        $latestEvents = DB::table('events as e1')
            ->select('e1.*')
            ->join(DB::raw('(SELECT character_id, MAX(created_at) as latest_event_date FROM events GROUP BY character_id) as e2'), function ($join) {
                $join->on('e1.character_id', '=', 'e2.character_id')
                    ->on('e1.created_at', '=', 'e2.latest_event_date');
            })
            ->orderByDesc('e1.character_id')
            ->get();
        
        return view('index-latest-events', compact('latestEvents'));   
    }

    
}
