<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    public function users() {
        return $this->belongsTo('App\User');
    }
}
