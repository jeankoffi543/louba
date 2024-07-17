<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateClient
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        Log::info($guards);
        foreach ($guards as $guard) {
            Log::info($guard,["e"=>Auth::guard($guard)]);
            if (Auth::guard($guard)->check()) {
                return $next($request);
            } else {
                return response()->json([
                    'status_code' => 401,
                    'status_message' => 'Utilisateur non connecté.',
                    'data' => null,
                ], 401);
            }
        }

        return $next($request);
    }
}
