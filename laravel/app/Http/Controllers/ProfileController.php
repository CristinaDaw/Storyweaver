<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


/**
 * @group Profiles
 *
 * Endpoints para administrar los perfiles.
 */
class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición del perfil de usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *      path="/api/profile/edit",
     *      operationId="edit",
     *      tags={"Profile"},
     *      summary="Muestra el formulario de edición del perfil de usuario",
     *      description="Muestra el formulario de edición del perfil de usuario.",
     *      @OA\Response(
     *          response=200,
     *          description="Devuelve la vista con el formulario de edición del perfil de usuario",
     *         
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualiza el perfil de usuario.
     *
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Post(
     *      path="/api/profile/update",
     *      operationId="update",
     *      tags={"Profile"},
     *      summary="Actualiza el perfil de usuario",
     *      description="Actualiza el perfil de usuario con los datos proporcionados en la solicitud.",
     *      @OA\RequestBody,
     *         
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona al formulario de edición del perfil",
     *          
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta de usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @OA\Delete(
     *      path="/api/profile/delete",
     *      operationId="destroyProfile",
     *      tags={"Profile"},
     *      summary="Elimina la cuenta de usuario",
     *      description="Elimina permanentemente la cuenta de usuario actual.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"password"},
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  format="password",
     *                  description="Contraseña actual del usuario"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=302,
     *          description="Redirecciona a la página de inicio",
     *          @OA\JsonContent(
     *              type="object"
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Contraseña incorrecta",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="The given data was invalid."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="password",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The password is incorrect."
     *                      )
     *                  )
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
