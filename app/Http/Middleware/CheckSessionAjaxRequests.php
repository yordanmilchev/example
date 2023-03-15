<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSessionAjaxRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if($request->ajax()) {
            if(empty(\Auth::user())){
                return response()->json([
                    'SESSION_STATUS' => 'NOT_LOGGED_IN'
                ]);
            }
            else{
                return $next($request);
            }
        }
        else{
            return $next($request);
        }
    }
}
