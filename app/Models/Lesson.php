<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
