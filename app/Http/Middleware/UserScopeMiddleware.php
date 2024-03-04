<?php

namespace App\Http\Middleware;

use App\Models\Note;
use App\Models\Scopes\UserScope;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserScopeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Note::addGlobalScope(new UserScope);
        Task::addGlobalScope(new UserScope);
        return $next($request);
    }
}
