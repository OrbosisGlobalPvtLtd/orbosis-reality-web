<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;

class Timezone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){

	
    $setting = Setting::first();
    $timezone = $setting->timezone ?? config('app.timezone'); // Fallback to app timezone if not set
    config(['app.timezone' => $timezone]);
    date_default_timezone_set($timezone);

    
    

    return $next($request);
}

}
