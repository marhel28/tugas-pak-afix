<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check()) {
            Log::info('User Activity', [
                'user_id' => Auth::id(),
                'user_id' => Auth::id(),
                'path' => $request->path(),
                'method' => $request->method(),
                'ip' => $request->ip()
            ]);
        }

        return $response;
    }
}
