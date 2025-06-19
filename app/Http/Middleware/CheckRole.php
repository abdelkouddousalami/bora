<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user has the required role
        if ($role === 'admin' && !$user->role === User::ROLE_ADMIN) {
            abort(403, 'Access denied. Admin role required.');
        }

        if ($role === 'user' && !$user->role === User::ROLE_USER) {
            abort(403, 'Access denied. User role required.');
        }

        return $next($request);
    }
}
