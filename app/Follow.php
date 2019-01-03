<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

  protected $fillable = [
    'user_id', 'post_id', 'followers_id', 'status'
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'followers_id');
  }

  public function post()
  {
    return $this->belongsTo('App\Post');
  }

}
