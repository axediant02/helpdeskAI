<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnansweredQuestions extends Model
{
    protected $fillable = [
        'question',
        'answer',
    ];
}
