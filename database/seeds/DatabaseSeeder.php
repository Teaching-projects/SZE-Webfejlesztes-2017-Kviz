<?php

use Illuminate\Database\Seeder;
use App\Persistence\Model\Question;
use App\Persistence\Model\Answer;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(QuestionAnswerSeeder::class);
    }
}

class QuestionAnswerSeeder extends Seeder{

    /**
     * Kérdések és válaszok feltöltése
     *
     * @return void
     */
    public function run()
    {
        $question = new Question(); //Új kérdés példányosítása.
        $question->question = "Mennyi 2+2?"; //A kérdés beállítása.
        $question->save(); //A kérdés mentése az adatbázisba.

        //Válaszok létrehozása és mentése az adatbázisba.
        $question->answers()->createMany([
            ['answer' => '1', 'is_correct' => false],
            ['answer' => '2', 'is_correct' => false],
            ['answer' => '3', 'is_correct' => false],
            ['answer' => '4', 'is_correct' => true],
        ]);

        //Egy újabb kérdés példányosítása, ha nem lenne akkor csak módosúlna az előző adatbázis bejegyzés.
        $question = new Question();
        $question->question = "Milyen színű az ég?";
        $question->save();

        $question->answers()->createMany([
            ['answer' => 'Zöld', 'is_correct' => false],
            ['answer' => 'Lila', 'is_correct' => false],
            ['answer' => 'Piros', 'is_correct' => false],
            ['answer' => 'Kék', 'is_correct' => true],
        ]);

        $question = new Question();
        $question->question = "Milyen színű az fű?";
        $question->save();

        $question->answers()->createMany([
            ['answer' => 'Zöld', 'is_correct' => true],
            ['answer' => 'Lila', 'is_correct' => false],
            ['answer' => 'Piros', 'is_correct' => false],
            ['answer' => 'Kék', 'is_correct' => false],
        ]);

    }
}
