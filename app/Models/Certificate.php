<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'cert_name',
        'threshold',
        'level'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
