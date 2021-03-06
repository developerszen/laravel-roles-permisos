<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'published' => 'boolean',
    ];

    function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function comments() {
        return $this->hasMany(Comment::class);
    }
}
