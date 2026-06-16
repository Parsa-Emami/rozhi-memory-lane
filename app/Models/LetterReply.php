<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterReply extends Model
{
    protected $fillable = [
        'nickname',
        'mood',
        'answer',
        'ip_hash',
    ];
}
