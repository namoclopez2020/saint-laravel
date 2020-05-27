<?php

namespace App\Http\Middleware;

use Closure;

class OfficeIsSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   if(session()->has('office')){
        return $next($request);
        }
        return redirect()->route('select.index')->with('error','seleccione la sucursal de trabajo');
    }
}
