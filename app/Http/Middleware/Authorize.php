<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorize
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Misal: cek level user
        $userLevel = $request->user()->level_id;

        // Contoh sederhana: cocokkan level_id dengan daftar
        $levelMapping = [
            1 => 'ADM',
            2 => 'MNG',
            3 => 'STF',
        ];

        if (!in_array($levelMapping[$userLevel] ?? '', $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
