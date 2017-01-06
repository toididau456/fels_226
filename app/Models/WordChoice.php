<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordChoice extends Model
{
    protected $fillable = [
        'id',
        'content',
        'correct'
        'created_at',
        'updated_at',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
