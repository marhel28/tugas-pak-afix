<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized access. Please login.'
                ], Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->route('login')->with([
                'error' => 'Please login to access this page.'
            ]);
        }

        if (!Auth::user()->hasRole('administrator')) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized access. Administrator privileges required.'
                ], Response::HTTP_FORBIDDEN);
            }

            abort(Response::HTTP_FORBIDDEN, 'Unauthorized access. Administrator privileges required.');
        }

        return $next($request);
    }
}
