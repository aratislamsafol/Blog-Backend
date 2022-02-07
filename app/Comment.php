<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'comment_text',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function post(){
    //     return $this->
    // }
}
