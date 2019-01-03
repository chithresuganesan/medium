<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function bookmark()
    {
       return $this->hasOne('App\Bookmark');
    }


}
