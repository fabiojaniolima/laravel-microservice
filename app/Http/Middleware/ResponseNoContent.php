<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResponseNoContent
{
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->route()->getActionMethod(), ['update', 'destroy'])) {
            $response = $next($request);
            if (is_numeric($response->content())) {
                return response()->noContent();
            }
        }

        return $next($request);
    }
}
