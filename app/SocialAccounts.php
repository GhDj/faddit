<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SocialAccounts extends Authenticatable
{
    use Notifiable;

    protected $table = 'social_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'driver', 'driver_id', 'fullobj'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
