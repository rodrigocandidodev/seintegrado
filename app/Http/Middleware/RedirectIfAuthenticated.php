<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        switch ($guard) {
            case 'core-admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('core-admin.dashboard');
                }
                break;
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.initialization');
                }
                break;
            case 'student':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('student.dashboard');
                }
                break;
            case 'teacher':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('teacher.initialization');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    dd(Auth::user());
                    return redirect('/home');
                }
                break;
        }
        
        return $next($request);
    }
}
