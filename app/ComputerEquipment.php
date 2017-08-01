<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComputerEquipment extends Model
{

    public function categories() {

        return $this->belongsTo('App\ComputerEquipmentCategory', 'category_id');

    }

    public function category() {

        return $this->belongsTo('App\ComputerEquipmentCategory', 'category_id');

    }

    public function user() {

        return $this->belongsTo('App\User');

    }

    public function doneUser() {
        return $this->belongsTo('App\User', 'done_user_id');
    }

}
