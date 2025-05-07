<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return Response
     */

    public function handle(Request $request, Closure $next, ...$roles)
    {

        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);

    }
}
