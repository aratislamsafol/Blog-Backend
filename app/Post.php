<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'post_title',
        'post_details',
        'post_img',
        'user_id',

    ];

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
