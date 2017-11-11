<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefineForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scoreboard', function (Blueprint $table) {
           $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('question_answer', function (Blueprint $table) {
            $table->foreign('answer_id')->references('id')->on('answer');
            $table->foreign('question_id')->references('id')->on('question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scoreboard', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('question_answer', function (Blueprint $table) {
            //Muszáj külön tömbben, különben nem jó a drop.
            $table->dropForeign(['answer_id']);
            $table->dropForeign(['question_id']);
        });
    }
}
