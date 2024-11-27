<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'score',
        'course_id',
        'certificate_id'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'question_tags');
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    // as of right now, we don't have multiple choice questions, so this will do
    public function correctAnswer()
    {
        return $this->hasOne(Answer::class)->where('correct', true);
    }
}
