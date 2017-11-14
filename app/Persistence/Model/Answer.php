<?php


namespace App\Persistence\Model;


use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $table = "answer";
    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function question(){
        return $this->belongsTo(Question::class,'question_id','id', Answer::class);
    }
}