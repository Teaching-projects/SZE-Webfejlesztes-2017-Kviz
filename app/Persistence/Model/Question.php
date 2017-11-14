<?php

namespace App\Persistence\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $table = "question";

    public function answers(){
        return $this->hasMany(Answer::class,'question_id','id', Question::class);
    }
}