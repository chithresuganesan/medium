<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function bookmark()
    {
      return $this->hasOne('App\Bookmark');
    }

    public function like()
    {
      return $this->hasOne('App\Like');
    }

    public function follow()
    {
      return $this->hasOne('App\Follow');
    }

    public function viewcount()
    {
      return $this->hasOne('App\Viewcount');

    }

    public function likes()
    {
      return $this->hasMany('App\Like');

    }

    public static function isPublished()
    {
      return static::where('status', 'pending');
    }

    public function getRouteKeyName()
    {
      return 'title';
    }

    public function scopeFilter($query, $value)
    {
        return $query->whereStatus($value);
    }


}
