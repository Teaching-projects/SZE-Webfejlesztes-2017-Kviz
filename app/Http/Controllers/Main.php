<?php


namespace App\Http\Controllers;

use App\Persistence\Model\Scoreboard;

class Main extends Controller
{
    //Főoldal view kiszolgálása
    public function index(){
        return view('index');
    }

    //Eredménytábla view kiszolgálása
    public function scoreboard(){
        $scores = Scoreboard::orderBy('score','desc')->get();
        return view('scoreboard')->with(['scores' => $scores]);
    }
}