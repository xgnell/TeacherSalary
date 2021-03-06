<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class TeacherMiddeware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard="teacher")
    {
        if(Auth::guard($guard)->check()){
            return $next($request);
        }
        return redirect()->back()->with('error', 'You need to login first');
    }
}
