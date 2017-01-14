<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'id',
        'content',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $dates = ['deleted_at'];

    public function wordChoices()
    {
        return $this->hasMany(WordChoice::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_words');
    }
    public function answers()
    {
        return $this->hasManyThrough(
            Answer::class,
            WordChoice::class,
            'word_id',
            'word_choice_id',
            'id'
        );
    }
    public function scopeLearned($query, $userId, $categoryId = null, $lessonId = null)
    {
        $query->join( 'word_choices', 'words.id', '=', 'word_choices.word_id')
                     ->join('answers', 'word_choices.id', '=', 'answers.word_choice_id')
                     ->join('lessons', 'lessons.id', '=', 'answers.lesson_id')
                     ->where('lessons.user_id', $userId)
                     ->where('correct', config('myApp.correct'));
        
        if ($lessonId) {
            $query->where('lessons.id', $lessonId);
        }

        if ($categoryId) {
            $query->where('lessons.category_id', $categoryid);
        }

        $query->select('words.*')->distinct();

        return $query;
    }

}
