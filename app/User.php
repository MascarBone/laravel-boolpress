<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relation One to One with user_infos
    public function userInfo ()
    {
        return $this->hasOne('App\Models\UserInfo');
    }

    //Relation One to Many with posts
    public function posts ()
    {
        return $this->hasMany('App\Models\Post');
    }

    //Relation Many to Many with roles
    public function roles() {
        return $this->belongsToMany('App\Models\Role','role_user');
    }
}
