<?php


namespace App\Http\Middleware;


use App\Http\Controllers\Main;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::user()->is_admin) {
            //Itt a szokásos módon nem lehet visszaadni: https://laravel.io/forum/08-28-2015-is-it-possible-to-return-a-view-from-a-middleware
            return new Response(view('message')->with(['message' => 'Az oldal megtekintéséhez admin jogosultság szükséges.']));
        }

        return $next($request);
    }

}