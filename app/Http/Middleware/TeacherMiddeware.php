<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
 
class TeacherMiddeware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard="tea")
    {
        if(Auth::guard($guard)->check()){
            return $next($request);
        }
        return redirect()->back()->with('error','bạn cần phải đăng nhập');
    }
}
