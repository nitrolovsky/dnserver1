<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category() {
        return $this->belongsTo('App\PostCategory', 'category_id');
    }
    public function users() {
        return $this->belongsTo('App\User');
    }
}
