<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class RoleMiddleware
{
   public function handle($request, Closure $next, $role)
{
    Log::info('RoleMiddleware ejecutado');
    Log::info('Rol esperado: ' . $role);

    if (!Auth::check()) {
        Log::info('Usuario no autenticado');
        return redirect('/login?role=' . $role);
    }

    $user = Auth::user();
    Log::info('Rol usuario: ' . $user->role);

    if ($user->role !== $role) {
        Log::info('Roles no coinciden, deslogueando usuario');
        Auth::logout();
        return redirect('/login?role=' . $user->role)
            ->with('error', 'Acceso denegado para ese rol.');
    }

    return $next($request);
}
}
