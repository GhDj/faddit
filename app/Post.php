<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = [
        'body', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

}
