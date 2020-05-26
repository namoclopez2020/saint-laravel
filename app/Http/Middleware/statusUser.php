<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class statusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->status == 0) {

            // usuario con sesión iniciada pero inactivo
        
            // cerramos su sesión
            Auth::guard()->logout();
        
            // invalidamos su sesión
            $request->session()->invalidate();
        
            // redireccionamos a donde queremos
            return redirect()->route('/')->with('error','Usuario inactivado, contacte con el administrador');;
        }
        return $next($request);
    }
}
