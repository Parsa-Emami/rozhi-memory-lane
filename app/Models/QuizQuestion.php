<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'question',
        'options',
        'emotional_result',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
