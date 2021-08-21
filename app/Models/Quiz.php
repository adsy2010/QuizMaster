<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function questions()
    {
        return $this->hasManyThrough(Question::class, QuizQuestion::class, 'quiz_id', 'id', 'id', 'question_id');
    }
}
