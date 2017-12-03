<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Scoreboard extends Controller
{
    public function add(Request $request){
        //Pontszám mentése az aktuális userhez https://laravel.com/docs/5.5/eloquent-relationships#the-create-method
        Auth::user()->scores()->create([
            'score' => session('point')
        ]);
    }
}