<?php

namespace BenjaminChen\Admin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    private $exceptPath = [
        'admin/login',
        'admin/logout',
    ];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->guest() && !in_array($request->path(), $this->exceptPath)) {
            return redirect()->guest('admin/login');
        }

        return $next($request);
    }
}