<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        // dd($guard);
        switch ($guard) {

            case 'admin':
                    if (Auth::guard($guard)->check()) {
                    return redirect('admin/home');
                }
                break;

            case 'user':
                    if (Auth::guard($guard)->check()) {
                    return redirect('user/home');
                }
                break; 

            case 'client':
                    if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;      
            
            default:
                    if (Auth::guard($guard)->check()) {
                   return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
