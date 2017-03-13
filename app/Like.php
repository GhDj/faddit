<?php
/**
 * Created by PhpStorm.
 * User: Alibi
 * Date: 13/03/2017
 * Time: 21:18
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    public $timestamps = true;
    protected $fillable = [
        'el_id', 'user_id', 'category'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}