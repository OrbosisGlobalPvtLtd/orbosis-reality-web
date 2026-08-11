<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->login_type === 'agent' || Auth::user()->login_type === 'user') {
                return $next($request);
            }

            $route = Auth::user()->login_type === 'builder' ? 'builder.dashboard' : 'user.dashboard';
            $notification = array('messege' => 'Unauthorized access', 'alert-type' => 'error');
            return redirect()->route($route)->with($notification);
        }


        return redirect()->route('login');
    }
}
