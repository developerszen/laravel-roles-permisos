<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    function user() {
        return $this->belongsTo(User::class);
    }
}
