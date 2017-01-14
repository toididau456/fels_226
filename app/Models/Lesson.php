<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'lesson_words');
    }
    public function lessonWord()
    {
        return $this->hasMany(LessonWord::class);
    }
    public function rightWords()
    {
        return $this->words()
                    ->join( 'word_choices', 'words.id', '=', 'word_choices.word_id')
                    ->join('answers', 'word_choices.id', '=', 'answers.word_choice_id')
                    ->where('correct', config('myApp.correct'))
                    ->distinct();
    }
}
