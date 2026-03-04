<?php

namespace App\Http\Middleware;

use App\Services\AccessControl;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFeatureIsEnable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $feature): Response
    {
        $map = [
            'registration' => fn() => AccessControl::registrationOpen(),
            'abstract'     => fn() => AccessControl::abstractSubmissionOpen(),
            'final'        => fn() => AccessControl::finalSubmissionOpen(),
        ];

        if (! isset($map[$feature]) || ! $map[$feature]()) {
            abort(403, 'This feature is currently closed.');
        }

        return $next($request);
    }
}
