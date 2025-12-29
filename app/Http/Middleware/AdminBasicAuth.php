<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $expectedUser = config('admin.user');
        $expectedPassword = config('admin.password');

        if (!$expectedUser || !$expectedPassword) {
            return response('Admin credentials are not configured.', 500);
        }

        $user = $request->getUser();
        $password = $request->getPassword();

        if ($user !== $expectedUser || $password !== $expectedPassword) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic',
            ]);
        }

        return $next($request);
    }
}
