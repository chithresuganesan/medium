<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
      'user_id', 'post_id', 'status'
    ];

    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function post()
    {
      return $this->belongsTo('App\Post');
    }

}
