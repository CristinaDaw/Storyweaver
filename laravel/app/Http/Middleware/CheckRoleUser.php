<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleUser
{
    /**
     * Valida que el usuario tenga rol de usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $roles = $user->roles;

        if (!$user || !$roles->contains('id', 2)) {
            return redirect()->route('dashboard.admin')->with('error', 'You cannot access this site.');
        }

        return $next($request);
    }
}
