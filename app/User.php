<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
       return $this->hasMany('App\Post');
    }

    public function bookmarks()
    {
       return $this->hasMany('App\Bookmark');
    }

    public function likes()
    {
      return $this->hasMany('App\Like', 'user_id');
    }

    public function follow()
    {
      return $this->hasOne('App\Follow');
    }

    public function followers()
    {
      return $this->belongsToMany('App\User', 'follows', 'user_id', 'followers_id')->where('status', 1);
    }

    public function bookmark()
    {
      return $this->hasOne('App\Bookmark');
    }
}
