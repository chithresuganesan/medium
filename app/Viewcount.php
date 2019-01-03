<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewcount extends Model
{

    protected $fillable = [
      'post_id', 'count'
  ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }



}
