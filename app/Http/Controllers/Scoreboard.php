<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Scoreboard extends Controller
{
    public function add(Request $request){
        $score = new \App\Persistence\Model\Scoreboard();
        $score->score = session('point');
        $score->user_id = Auth::user()->id;
        $score->save();
    }
}