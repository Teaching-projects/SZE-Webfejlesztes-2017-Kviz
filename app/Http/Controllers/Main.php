<?php


namespace App\Http\Controllers;

use App\Persistence\Model\Scoreboard;
use App\Persistence\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    //Játék view kiszolgálása
    public function game(){
        Game::resetGame();
        return view('game')->with(['quiz_length' => config('app.quiz_length'), 'answer_timeout' => config('app.answer_timeout')]);
    }

    //Regisztálció view kiszolgálása
    public function registration(){
        return view('registration');
    }

    //Regisztálció feldolgozása
    public function processRegistration(Request $request){
        /*
            Adatok validálása a beépített validátorral, ha rossz visszavisz az előző oldalra és az error paraméterben lesz a hiba
            https://laravel.com/docs/5.5/validation#quick-writing-the-validation-logic
         */
        $request->validate([
            'name' => 'required|unique:user|max:255',
            'email' => 'required|unique:user|max:255',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);
        //Új felhasználó példányosítása
        $user = new User();
        //A postban érkezett adatok beállítása az user objektumnak
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save(); //Felhasználó mentése az adatbázisba
        Auth::login($user); //Felhasználó bejelentkeztetése
        return redirect('/'); //Visszairányítás a kezdőlapra
    }

    public function login(){
        return view('login');
    }

    public function processLogin(Request $request){
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect('/'); //Sikeres bejekentkezés esetén vissza a főoldalra
        }
        else{
            return back()->withErrors(['message' => 'Hibás felhasználónév vagy jelszó.']);
        }
    }

    public function logout(){
        Auth::logout(); //Kijelentkeztetés
        return redirect('/'); //Visszairányítás a kezdőlapra
    }

    public static function gameIsEnd(){
        return config('app.end_date') < date('Y-m-d');
    }
}