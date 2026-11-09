<?php

namespace App\Http\Middleware;

use BackedEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restricts an API route to users whose role is one of the given values, e.g. `api.role:Admin,Clerk`.
 * Named differently from any web role middleware so the two can never collide.
 */
class EnsureApiRole
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        $role = $user?->role instanceof BackedEnum ? $user->role->value : (string) $user?->role;

        if (! $user || ! in_array($role, $roles, true)) {
            return response()->json([
                'message' => 'This area is available to '.Arr::join($roles, ', ', ' and ').' accounts only.',
            ], 403);
        }

        return $next($request);
    }
}
