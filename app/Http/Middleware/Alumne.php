<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Alumne
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->admin || Auth::user()->professor_id != null || Auth::user()->alumne_id != null){
            return $next($request);
        }else{
            abort(403, "Sol·licitud denegada, àrea per alumnes");
        }
        
    }
}
