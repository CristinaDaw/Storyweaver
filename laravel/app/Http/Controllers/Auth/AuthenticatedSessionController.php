<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

         // Aquí obtenemos los roles del usuario actual
         $user = Auth::user();
         $roles = $user->roles;
 
         // Redirigiremos según la cantidad de roles y el ID del rol
         switch ($roles->count()) {
             case 2:
                 return redirect()->intended(RouteServiceProvider::ADMINHOME);
             case 1:
                 $role = $roles->first();
                 switch ($role->id) {
                     case 1:
                         return redirect()->intended(RouteServiceProvider::ADMINHOME);
                     case 2:
                         return redirect()->intended(RouteServiceProvider::HOME);
                     default:
                         throw ValidationException::withMessages([
                             'email' => [trans('auth.failed')],
                         ]);
                 }
             default:
                 throw ValidationException::withMessages([
                     'email' => [trans('auth.failed')],
                 ]);
         }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
