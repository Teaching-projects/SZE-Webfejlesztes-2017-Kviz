<?php


namespace App\Http\Middleware;


use App\Http\Controllers\Main;
use Closure;
use Illuminate\Http\Response;

class RedirectIfGameEnd
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (Main::gameIsEnd()) {
            //Itt a szokásos módon nem lehet visszaadni: https://laravel.io/forum/08-28-2015-is-it-possible-to-return-a-view-from-a-middleware
            return new Response(view('gameend'));
        }

        return $next($request);
    }

}