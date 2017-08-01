<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class AuthedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('authed')) {
            Session::flash('danger', 'Требуется пройти аутентификацию.');
            return Redirect::to("/user/login");
        }
        return $next($request);
    }
}
