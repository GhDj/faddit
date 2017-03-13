<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_like';
    public $timestamps = true;
    protected $fillable = [
        'comment_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
