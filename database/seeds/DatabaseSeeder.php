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
     * Kérdések és válaszok feltöltése.
     *
     * @return void
     */
    public function run()
    {
        $question = new Question();
        $question->question = "Mennyi 2+2?";
        $question->save();

        $question->answers()->saveMany([
            $answer = new Answer(['answer' => '1', 'is_correct' => false]),
            $answer = new Answer(['answer' => '2', 'is_correct' => false]),
            $answer = new Answer(['answer' => '3', 'is_correct' => false]),
            $answer = new Answer(['answer' => '4', 'is_correct' => true]),
        ]);

        $question = new Question();
        $question->question = "Milyen színű az ég?";
        $question->save();

        $question->answers()->saveMany([
            $answer = new Answer(['answer' => 'Zöld', 'is_correct' => false]),
            $answer = new Answer(['answer' => 'Lila', 'is_correct' => false]),
            $answer = new Answer(['answer' => 'Piros', 'is_correct' => false]),
            $answer = new Answer(['answer' => 'Kék', 'is_correct' => true]),
        ]);

        $question = new Question();
        $question->question = "Milyen színű az fű?";
        $question->save();

        $question->answers()->saveMany([
            $answer = new Answer(['answer' => 'Zöld', 'is_correct' => true]),
            $answer = new Answer(['answer' => 'Lila', 'is_correct' => false]),
            $answer = new Answer(['answer' => 'Piros', 'is_correct' => false]),
            $answer = new Answer(['answer' => 'Kék', 'is_correct' => false]),
        ]);

    }
}
