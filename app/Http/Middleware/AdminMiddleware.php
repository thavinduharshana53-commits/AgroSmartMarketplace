<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        /*
         * Only authenticated Admin users
         * can access Admin routes.
         */
        abort_unless(
            $user && $user->role === 'admin',
            403,
            'You are not authorized to access the Admin panel.'
        );

        /*
         * Block access when the Admin account
         * has been disabled.
         */
        if ($user->account_status !== 'active') {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Your account has been blocked.',
                ]);
        }

        return $next($request);
    }
}