<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\View;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    // public function handle($request, Closure $next, ...$guards)
    // {
    //     if ($this->authenticate($request, $guards)) {
    //         return $next($request);
    //     }
    //     if ($this->authenticate($request, ['web_pengusul', 'auth_penelaah'])) {
    //         return $next($request);
    //     }
    //     return redirect('/');
    // }

    // /**
    //  * Determine if the user is logged in to any of the given guards.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  array  $guards
    //  * @return void
    //  *
    //  * @throws \Illuminate\Auth\AuthenticationException
    //  */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                // return $this->auth->shouldUse($guard);
                return true;
            }
        }

        // throw new AuthenticationException(
        //     'Unauthenticated.',
        //     $guards,
        //     $this->redirectTo($request)
        // );
        return false;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    // protected function redirectTo($request)
    // {
    //     if (!$request->expectsJson()) {
    //         return route('/');
    //     }
    // }

}
