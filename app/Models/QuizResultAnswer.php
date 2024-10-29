<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResultAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_result_id',
        'question_id',
        'answer_id',
        'time_taken'
    ];

    public function quizResult() {
        return $this->belongsTo(QuizResult::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function answer() {
        return $this->belongsTo(Answer::class);
    }
}