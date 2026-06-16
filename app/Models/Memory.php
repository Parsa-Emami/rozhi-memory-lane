<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $fillable = [
        'title',
        'place',
        'memory_date',
        'description',
        'image_path',
        'mood',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'memory_date' => 'date',
        'is_featured' => 'boolean',
    ];
}
