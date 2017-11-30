<?php


namespace App\Http\Controllers;
use App\Persistence\Model\Question;
use Illuminate\Http\Request;

class Game extends Controller
{
    //Játék újraindítása.
    public static function resetGame(){
        //Utolsó kérdés azonosítójának a törlése
        session()->forget('questionID');
        //Megválaszolt kérdések tömb törlése, pontok nullázása és visszamaradt kérdések alapértelmezettre állítása
        session(['excluded' => [],'point' => 0, 'remainingQuestion' => config('app.quiz_length')]);
    }

    //Újabb kérdés lekérdezése
    public function getQuestion(){
        $this->decreaseremainingQuestion();
        //Ha valami csoda módján direkt hívja.
        if(is_null(session()->get('excluded')))
            self::resetGame();

        //Eddig nem szerepelt kérdés lekérdezése az adatbázisból.
        $question = Question::whereNotIn('id',session()->get('excluded'))->inRandomOrder()->first();

        //Kérdéshez tartozó válaszok lekérdezése véletlenszerű sorrendben.
        $answers = $question->answers()->inRandomOrder()->get();

        //Kérdés id és kiszolgálás idejének beállítása.
        session(['questionID' => $question->id,'questionTime' => microtime(TRUE)]);

        //JSON kiszolgálása.
        return response()->json(['question' => $question, 'answers' => $answers]);
    }

    //Kérdések feldolgozása
    public function processAnswer(Request $request){

        //Válasz beérkezésének az idejének a lementése.
        $answerTime = microtime(TRUE); //Save Date

        //A kérdés lekérése a session id alapján.
        $question = Question::find(session('questionID'));

        //A kérdéshez tartozó helyes válasznak a lekérdezése.
        $answer = $question->answers()->where('is_correct',true)->first();

        //Kérdés id hozzáadása a megválaszolt kérdésekhez a sessionben.
        session()->push('excluded', $question->id);

        //Ha érkezett a kérdésre válasz és az helyes akkor meghívódik az addPoint metódus.
        if($request->has('answerID') && $answer->id == $request->input('answerID'))
            $this->addPoint($answerTime,session('questionTime'));

        //JSON kiszolgálása
        return response()->json(['answer' => $answer,'point' => session('point')]);
    }
    protected function addPoint($answerTime,$questionTime){
        //Eltelt idő számítása
        $elapsedTime = ($answerTime - $questionTime) * 1000;
        //Elért pontok számítása
        $roundPoint = round((config('app.answer_timeout') * 1000 - $elapsedTime) / 10);
        //Ha a pont nagyobb mint akkor a sessionben hozzáadjuk a pontokat
        if($roundPoint > 0)
            session(['point' => session('point') + $roundPoint]);
    }

    //Hátramaradt kérdések számának csökkentése.
    protected function decreaseremainingQuestion($num = 1){
        $remainingQuestion = session('remainingQuestion');
        //Nulla vagy kevesebb hátralévő kérdés esetén hiba történt
        if($remainingQuestion <= 0)
            abort(500);
        session(['remainingQuestion' => --$remainingQuestion]);
    }
}