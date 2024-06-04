<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleAdmin
{
    /**
     * Valida que el usuario tenga rol de administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     *  
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $roles = $user->roles;

        if (!$user || !$roles->contains('id', 1)) {
            return redirect()->route('dashboard')->with('error', 'You have no admin permissions to access this site.');
        }

        return $next($request);
    }
}
