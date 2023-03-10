<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MissingParameterMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $routeParameters = $request->route()->parameters();

        foreach ($request->route()->parameterNames() as $name) {
            if (!isset($routeParameters[$name])) {
                return response()->json(['error' => 'Página não encontrada.'], 404);
            }
        }

        return $next($request);
    }
}
