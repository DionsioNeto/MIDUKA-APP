<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use illuminate\Support\Facades\Auth;

class adminAcess{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response{
        if(Auth::check()){
            dd("Chegou");
            return $next($request);
        }else{
            dd("Inicie sua sessão... ");
        }
            
    }
}
