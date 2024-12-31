<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        Log::info('Role Middleware', [
            'user_role' => $request->user()?->role,
            'required_role' => $role,
            'is_authenticated' => $request->user() ? 'yes' : 'no',
            'path' => $request->path()
        ]);

        // If user is not logged in and trying to access login pages, let them through
        if (!$request->user() && $request->is('*/login', '*/register')) {
            return $next($request);
        }

        // If user is logged in and has the required role, let them through
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // If user is logged in but doesn't have the right role, redirect them
        if ($request->user()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // If user is not logged in, redirect to login
        return redirect()->route('login');
    }
}