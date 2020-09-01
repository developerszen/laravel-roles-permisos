<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $casts = [
        'published' => 'boolean',
    ];

    function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
