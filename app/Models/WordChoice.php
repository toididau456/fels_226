<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordChoice extends Model
{
    protected $table='word_choices';
    protected $fillable = [
        'id',
        'content',
        'correct',
        'word_id',
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
