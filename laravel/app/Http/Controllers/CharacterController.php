<?php

namespace App\Http\Controllers;


use App\Models\Character;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

/**
 * @group Characters
 *
 * Endpoints para administrar los personajes.
 */

class CharacterController extends Controller
{
    /**
     * Mostrar todos los personajes.
     *
     * Obtiene una lista de todos los personajes registrados.
     *
     * @response {
     *   "characters": [
     *     {
     *       "id": 1,
     *       "name": "Nombre del personaje",
     *       "description": "Descripción del personaje"
     *     },
     *     {
     *       "id": 2,
     *       "name": "Otro personaje",
     *       "description": "Otra descripción"
     *     }
     *   ]
     * }
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $characters = Character::all();
        return view('character.index', compact('characters'));
    }


    /**
     * Muestra un personaje por nombre.
     *
     * Retorna una vista que muestra un personaje específico basado en su nombre.
     *
     * @queryParam name string required El nombre del personaje. Ejemplo: John Smith
     *
     * @response view character.show
     *
     * @response 302 view dashboard.admin
     *
     * @return \Illuminate\Http\Response
     */

    public function indexByName($name)
    {
        $character = Character::where('name', $name)->first();
        if ($character) {
            return view('character.show')->with('character', $character);
        } else {
            return "<p class=\"ml-8 text-gray-600\">There is no character with that name.</p>";
        }
    }


    /**
     * Muestra el formulario de creación de un personaje.
     *
     * Retorna una vista que muestra el formulario de creación de un nuevo personaje
     * para un juego específico.
     *
     * @urlParam game_id int required El ID del juego al que se asociará el personaje.
     *
     * @response view dashboard
     * @response view character.create
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $game_id = $request->route('game_id');

        $game = Game::findOrFail($game_id);
        $character = $game->character;

        if ($game && $character) {
            return view('dashboard');
        } else {
            return view('character.create');
        }
    }



    /**
        * Almacena un nuevo personaje.
        *
        * Crea y almacena un nuevo personaje con los datos proporcionados.
        *
        * @bodyParam game_id int required El ID del juego al que se asociará el personaje.
        * @bodyParam name string required El nombre del personaje.
        * @bodyParam class string required La clase del personaje.
        * @bodyParam race string required La raza del personaje.
        * @bodyParam faction string required La facción del personaje.
        * @bodyParam background string required El trasfondo del personaje.
        *
        * @response 302 {
        *     "character_id": 1
        * }
        *
        * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string',
            'race' => 'required|string',
            'faction' => 'required|string',
            'background' => 'required|string',
            'img_avatar' => 'required|string'
        ]);

        $character = new Character();
        $character->game_id =$request->input('game_id');
        $character->name =$request->input('name');
        $character->class =$request->input('class');
        $character->race =$request->input('race');
        $character->faction =$request->input('faction');
        $character->background =$request->input('background');
        $character->img_avatar =$request->input('img_avatar');
        $character->save();


        return Redirect::route('event.store.initial', ['character_id' => $character->id]);
    }



    /**
     * Muestra el formulario para editar un personaje específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *     path="/characters/{id}/edit",
     *     summary="Muestra el formulario para editar un personaje específico",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personaje",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vista del formulario para editar el personaje"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Character not found"
     *     )
     * )
     */
    public function edit($id)
    {

        $character = Character::FindOrFail($id);

        if(!$character){
            abort(404, 'Character not found.');
        } else{
            return view('character.edit', compact('character'));
        }

    }


    /**
     * Actualiza un personaje específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Put(
     *     path="/characters/{id}",
     *     summary="Actualiza un personaje específico",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personaje",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="El nombre del personaje"
     *                 ),
     *                 @OA\Property(
     *                     property="class",
     *                     type="string",
     *                     description="La clase del personaje"
     *                 ),
     *                 @OA\Property(
     *                     property="race",
     *                     type="string",
     *                     description="La raza del personaje"
     *                 ),
     *                 @OA\Property(
     *                     property="faction",
     *                     type="string",
     *                     description="La facción del personaje"
     *                 ),
     *                 @OA\Property(
     *                     property="background",
     *                     type="string",
     *                     description="El trasfondo del personaje"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Character updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Character not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $character->name = $request->filled('name') ? $request->input('name') : $character->name;
        $character->class = $request->filled('class') ? $request->input('class') : $character->class;
        $character->race = $request->filled('race') ? $request->input('race') : $character->race;
        $character->faction = $request->filled('faction') ? $request->input('faction') : $character->faction;
        $character->background = $request->filled('background') ? $request->input('background') : $character->background;
        $character->img_avatar = $request->filled('img_avatar') ? $request->input('img_avatar') : $character->img_avatar;

        $character->save();

        return Redirect::route('dashboard')
        ->with('success', 'Character updated successfully');
    }

    /**
     * Elimina un personaje específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Delete(
     *     path="/characters/{id}",
     *     summary="Elimina el personaje especificado",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personaje",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful character delete"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="You have no permission"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Character not found"
     *     )
     * )
 */
    public function destroy($id)
    {
        if (Auth::check()) {
            $character = Character::find($id);
            $roleAdmin = auth()->user()->roles->where('id', 1)->first();

            if (!$character) {
                abort(404, 'Character not found.');
            }

            if ($roleAdmin || Auth::id() === $character->game->user_id) {

                $character->delete();

                // Redirige según el rol del usuario
                $redirectRoute = $roleAdmin ? 'dashboard.admin' : 'dashboard';

                return redirect()->route($redirectRoute)->with('success', 'Successful character delete!');

            } else {
                abort(403, 'You have no permission!');
            }
        } else {
            abort(403, 'You have no permission.');
        }
    }

}
