<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
//        dd($request->user()->roles);
        if (!($request->user()->roles->isEmpty()) && $request->user()->getRoleNames()[0] == 'admin') {
            return $response;
        } else {
            return redirect('/')->withErrors(['unauthorized' => 'You are not authorized to access']);
        }
//        return $next($request);
    }
}
