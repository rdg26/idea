<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        app()->setLocale(
            session('locale', config('app.locale'))
        );

        Carbon::setLocale(app()->getLocale());

        return $next($request);
    }
}