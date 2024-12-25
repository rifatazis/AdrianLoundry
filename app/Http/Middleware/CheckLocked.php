<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLocked
{
    public function handle(Request $request, Closure $next)
    {
        
        if (session('locked')) {
            return redirect('/lock'); 
        }

        return $next($request); 
    }
}
