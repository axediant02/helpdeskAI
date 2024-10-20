<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnanseredQuestions extends Model
{
    protected $fillable = [
        'question',
        'answer',
    ];
}
