<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The social accounts associated with the user
     */
    public function socialAccounts()
    {
        return $this->hasMany('App\UserSocialAccount');
    }

    /**
     * Users may have many applications
     */
    public function applications() {
        return $this->hasMany('App\Models\Application\Application');
    }

    public function socialAccount($provider) {
        return UserSocialAccount::where('provider', $provider)->where('user_id', $this->id)->first();
    }


}
