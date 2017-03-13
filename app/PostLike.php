<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = 'post_like';
    public $timestamps = true;
    protected $fillable = [
        'post_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
