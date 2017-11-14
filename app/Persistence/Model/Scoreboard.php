<?php


namespace App\Persistence\Model;


use Illuminate\Database\Eloquent\Model;

class Scoreboard extends Model
{
    public $table = "scoreboard";

    public function user(){
        return $this->belongsTo(User::class,'user_id',id,Scoreboard::class);
    }
}