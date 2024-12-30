<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // If user is not logged in and trying to access login pages, let them through
        if (!$request->user() && $request->is('*/login', '*/register')) {
            return $next($request);
        }

        // If user is logged in but doesn't have the right role, redirect them
        if ($request->user() && !in_array($request->user()->role, $roles)) {
            return redirect()->to($this->getRedirectUrl($request->user()->role));
        }

        return $next($request);
    }

    private function getRedirectUrl(string $role): string
    {
        return match ($role) {
            'admin' => '/admin',
            'freelancer' => '/freelancer',
            'client' => '/',
            default => '/',
        };
    }
}
