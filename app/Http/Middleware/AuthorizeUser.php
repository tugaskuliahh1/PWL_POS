<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()){
            return redirect('login');
        }
        $userRole = Auth::user()->role;

        foreach($roles as $role){
            if ($userRole == $role) {
                return $next($request);
            }
        }
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}
