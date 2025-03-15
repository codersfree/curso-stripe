<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSuscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user()->subscribed('Suscripciones blog')) {
            return $next($request);
        }

        session()->flash('flash.banner', 'Debes estar suscrito para ver este artículo');

        return redirect()->route('billings.index');
    }
}
