<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


/**
 * @group Users
 *
 * Endpoints para administrar los usuarios.
 */
class UserController extends Controller
{
    /**
     * Muestra todos los usuarios.
     *
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *      path="/api/users",
     *      operationId="indexUsers",
     *      tags={"Users"},
     *      summary="Muestra todos los usuarios",
     *      description="Recupera todos los usuarios registrados en la base de datos.",
     *      @OA\Response(
     *          response=200,
     *          description="Devuelve la vista con todos los usuarios",
     *          
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }


    /**
     * Mostrar usuario por nombre.
     *
     * @param  string  $name
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     *
     * @OA\Get(
     *     path="/users/{name}",
     *     summary="Mostrar usuario por nombre",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="Nombre del usuario",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vista para mostrar al usuario"
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redirección al panel de admin"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function indexByName($name)
    {
        $user = User::where('name', $name)->first();
        if ($user) {
            return view('users.show')->with('user', $user);
        } else {
            return "<p class=\"ml-8 text-gray-600\">There is no user with that name.</p>";
        }
    }

    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *     path="/register",
     *     summary="Muestra el formulario de registro",
     *     tags={"Authentication"},
     *     @OA\Response(
     *         response=200,
     *         description="Vista para mostrar el formulario de registro"
     *     )
     * )
     */

    public function create()
    {
        return view('auth.register');
    }

    /**
     * Almacena un nuevo usuario creado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Post(
     *     path="/register",
     *     summary="Almacena un nuevo usuario creado",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="El nombre del usuario"
     *                 ),
     *                 @OA\Property(
     *                     property="nickname",
     *                     type="string",
     *                     description="El nickname del usuario"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                     description="El email del usuario"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="La contraseña del usuario"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->nickname = $request->input('nickname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->roles()->attach(2); //Como es un usario normal le asignamos rol User

        return $this->index()->with('success', '¡Registro exitoso!');
    }

    
    /**
     * Muestra el formulario de edición de usuario.
     *
     * @param int $id ID del usuario a editar
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *      path="/api/users/{id}/edit",
     *      operationId="editUser",
     *      tags={"Users"},
     *      summary="Muestra el formulario de edición de usuario",
     *      description="Muestra el formulario de edición de usuario para que un administrador pueda editar los detalles del usuario.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del usuario",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Devuelve la vista con el formulario de edición de usuario",
     *          @OA\JsonContent(
     *              type="object"
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="No tienes permisos para editar este usuario",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="You have no permissions to edit this user profile!"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
 */

    public function edit($id){

        $user = User::find($id);
        
        
        if (!$user || auth()->user()->roles->first()->id != 1) {
            abort(403, 'You have no permissions to edit this user profile!');
        }

        return view('users.edit', ['user_id' => $user->id]);
        
    }   

    /**
     * Actualiza los detalles de un usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id ID del usuario a actualizar
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Put(
     *      path="/api/users/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Actualiza los detalles de un usuario",
     *      description="Actualiza los detalles de un usuario en la base de datos.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del usuario",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe",
     *                  description="Nombre del usuario"
     *              ),
     *              @OA\Property(
     *                  property="nickname",
     *                  type="string",
     *                  example="johndoe",
     *                  description="Apodo del usuario"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  example="john@example.com",
     *                  description="Correo electrónico del usuario"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  format="password",
     *                  example="newpassword123",
     *                  description="Nueva contraseña del usuario"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona al panel de administración",
     *          @OA\JsonContent(
     *              type="object"
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Usuario no encontrado",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User not found."
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */


    public function update(Request $request, $id) {
                
        $user = User::findOrFail($id);

       
        $user->name = $request->filled('name') ? $request->input('name') : $user->name;
        $user->nickname = $request->filled('nickname') ? $request->input('nickname') : $user->nickname;
        $user->email = $request->filled('email') ? $request->input('email') : $user->email;
        $user->password = $request->filled('password') ? bcrypt($request->input('password')) : $user->password;
        $user->save();

        return redirect()->route('dashboard.admin');
    }


    /**
     * Elimina un usuario específico.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Delete(
     *     path="/users/{user_id}",
     *     summary="Elimina un usuario específico.",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="User deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
 */
    public function destroy($user_id)
    {
        // Encuentra el usuario por su ID
        $user = User::find($user_id);

        // Verifica si el usuario existe
        if ($user) {
            // Elimina el usuario
            $user->delete();

            // Redirecciona a alguna ruta deseada con un mensaje de éxito
            return redirect()->route('dashboard.admin')->with('success', 'User deleted successfully.');
        } else {
            // Si el usuario no se encuentra, redirecciona a alguna ruta deseada con un mensaje de error
            return redirect()->route('dashboard.admin')->with('error', 'User not found.');
        }
    }
}