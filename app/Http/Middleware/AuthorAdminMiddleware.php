<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class AuthorAdminMiddleware
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
        if (Session::get('access') < 14000) {
            Session::flash('danger', 'Недостаточно прав для выполнения данного действия.');
            return Redirect::back();
        }
        return $next($request);
    }
}
