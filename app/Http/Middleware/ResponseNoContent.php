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

            if ($response->getContent() === '1') {
                return response()->noContent();
            }
        }

        return $next($request);
    }
}
