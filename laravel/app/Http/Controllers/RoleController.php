<?php

namespace App\Http\Controllers;

use App\Models\Role;


/**
 * @group Roles
 *
 * Endpoints para administrar los roles.
 */
class RoleController extends Controller
{
    /**
     * Muestra todos los roles.
     *
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *      path="/api/roles",
     *      operationId="index",
     *      tags={"Roles"},
     *      summary="Muestra todos los roles",
     *      description="Recupera todos los roles disponibles en la base de datos.",
     *      @OA\Response(
     *          response=200,
     *          description="Devuelve la vista con todos los roles"     *          
     *      ),
     *      security={
     *          {"bearerAuth": {}}
     *      }
     * )
     */

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }


    /**
     * Muestra un rol por ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|string
     *
     * @OA\Get(
     *     path="/roles/{id}",
     *     summary="Muestra un rol por ID",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del rol",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vista para mostrar el rol"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found"
     *     )
     * )
     */
    public function indexByID($id)
    {
        $role = Role::where('id', $id)->first();
        if ($role) {
            return view('roles.show')->with('role', $role);
        } else {
            return "<p class=\"ml-8 text-gray-600\">There is no role with that ID.</p>";
        }
    }

}
