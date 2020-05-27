<?php

namespace App\Http\Middleware;

use Closure;
use App\General;

class CheckGeneralData
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
        $general = General::first();
        
        if($general == NULL){
            return redirect()->route('general.index')->with('status','Configure los parametros generales');
        }
        return $next($request);
    }
}
