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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wordChoices()
    {
        return $this->hasMany(WordChoice::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_words');
    }
}
