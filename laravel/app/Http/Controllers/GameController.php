<?php

namespace App\Http\Controllers;


use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * @group Games
 *
 * Endpoints para administrar los juegos.
 */
class GameController extends Controller
{
    /**
     * Muestra un listado de todos los juegos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }


    /**
     * Muestra un juego por ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|string
     *
     * @OA\Get(
     *     path="/games/{id}",
     *     summary="Muestra un juego por ID",
     *     tags={"Games"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del juego",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vista para mostrar el juego"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Game not found"
     *     )
     * )
     */
    public function indexByID($id)
    {
        $game = Game::where('id', $id)->first();
        if ($game) {
            return view('games.show')->with('game', $game);
        } else {
            return "<p class=\"ml-8 text-gray-600\">There is no game with that ID.</p>";
        }
    }



    /**
     * Almacena un nuevo juego.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Post(
     *      path="/api/games",
     *      operationId="store",
     *      tags={"Games"},
     *      summary="Almacena un nuevo juego",
     *      description="Crea un nuevo registro de juego en la base de datos.",
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona a la página de creación de personajes",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="game_id",
     *                  type="integer",
     *                  example="1"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function store()
    {
        $userId = Auth::id();

        $game = new Game();
        $game->user_id =$userId;
        $game->status ='Active';
        $game->context = null;
        $game->img_register = null;
        $game->save();


        return redirect()->route('character.create', ['game_id' => $game->id]);
    }


    /**
     * Muestra los detalles de un juego específico.
     *
     * @param int $game_id ID del juego a mostrar
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *      path="/api/games/{game_id}",
     *      operationId="show",
     *      tags={"Games"},
     *      summary="Muestra los detalles de un juego específico",
     *      description="Recupera los detalles de un juego específico en la base de datos.",
     *      @OA\Parameter(
     *          name="game_id",
     *          in="path",
     *          description="ID del juego",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Devuelve la vista con los detalles del juego",
     *
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Juego no encontrado",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Juego no encontrado"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */


    public function show($game_id)
    {
        $game = Game::findOrFail($game_id);

        return view('games.show', compact('game'));
    }

    public function getContext($game_id): \Illuminate\Http\JsonResponse
    {
        $context = Game::findOrFail($game_id)->context;

        return response()->json($context);
    }


    /**
     * Finaliza un juego.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Post(
     *      path="/api/games/finish",
     *      operationId="finish",
     *      tags={"Games"},
     *      summary="Finaliza un juego",
     *      description="Actualiza el estado de un juego a 'Finalizado' en la base de datos.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"game_id"},
     *              @OA\Property(
     *                  property="game_id",
     *                  type="integer",
     *                  example="1"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona al evento de finalización del juego",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="character_id",
     *                  type="integer",
     *                  example="1"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Juego no encontrado",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Juego no encontrado"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
    */

    public function finish(Request $request)
    {
        $game_id = $request->route('game_id');
        $game = Game::findOrFail($game_id);

        // Verificamos si el juego existe
        if (!$game) {
            if(auth()->check() && auth()->user()->roles->first()->id == 1){
                return redirect()->route('dashboard.admin')->with('error', 'The game does not exist.');
            } else {
                return redirect()->route('dashboard')->with('error', 'The game does not exist.');
            }

        }

        // Actualizamos el estado del juego a "Finalizado"
        $game->update(['status' => 'Finished']);

        return Redirect::route('event.store.ending', ['game_id' => $game->id]);
    }

    /**
     * Elimina un juego.
     *
     * @param int $id ID del juego a eliminar
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Delete(
     *      path="/api/games/{id}",
     *      operationId="destroyGame",
     *      tags={"Games"},
     *      summary="Elimina un juego",
     *      description="Elimina un juego específico de la base de datos.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del juego",
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
     *                  example="Successful game delete!"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Juego no encontrado",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Game not found."
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Sin permisos para eliminar el juego",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="You have no permission! You are not the owner of this game!"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function resume($game_id)
    {
        $game = Game::where('id', $game_id)->first();
        if ($game) {
            return view('games.chat', compact('game'));
        } else {
            return "<p class=\"ml-8 text-gray-600\">There is no game with that ID.</p>";
        }
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            $game = Game::find($id);
            $roleAdmin = auth()->user()->roles->where('id', 1)->first();

            if (!$game) {
                abort(404, 'Game not found.');
            }

            if ($roleAdmin || Auth::id() === $game->user_id) {

                $game->delete();

                // Redirige según el rol del usuario
                $redirectRoute = $roleAdmin ? 'dashboard.admin' : 'dashboard';

                return redirect()->route($redirectRoute)->with('success', 'Successful game delete!');

            } else {
                abort(403, 'You have no permission! You are not the owner of this game!');
            }
        } else {
            abort(403, 'You have no permission.');
        }
    }

}
