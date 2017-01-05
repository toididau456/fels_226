<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonWord extends Model
{
    protected $fillable = [
        'id',
        'word_id',
        'lesson_id',
        'created_at',
        'updated_at',
    ];
}
