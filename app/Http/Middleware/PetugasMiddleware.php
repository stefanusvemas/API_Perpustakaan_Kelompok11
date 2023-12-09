<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PetugasMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user() instanceof \App\Models\Petugas) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
