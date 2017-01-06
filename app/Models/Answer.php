<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'id',
        'word_choice_id',
        'lesson_id'
        'created_at',
        'updated_at',
    ];
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    
    public function wordChoice()
    {
        return $this->belongsTo(WordChoice::class);
    }
}
