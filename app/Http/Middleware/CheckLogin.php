<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        if (session()->has('adminid')) {
            return $next($request); //继续执行
        } else {
            header('location:' . url('admin/login'));
            exit();
        }

    }
}
