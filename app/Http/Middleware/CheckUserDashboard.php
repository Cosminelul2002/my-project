<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        dd($request->user()->hasRole('user'));
        if ($request->user()->hasRole('user')) {
            if ($request->session()->has('user_id')) {
                $userId = $request->route('id');

                if ($userId != $request->session()->get('user_id')) {
                    return redirect()->route('user.dashboard', $request->session()->get('user_id'));
                }
            }
            return $next($request);
        };
    }
}
