<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function company() {

        return $this->belongsTo('App\Company');

    }

    public function department() {

        return $this->belongsTo('App\Department');

    }

    public function duty() {

        return $this->belongsTo('App\Duty');

    }

    public function posts() {

        return $this->hasMany('App\Post');

    }

    public function computer_equipments() {

        return $this->hasMany('App\ComputerEquipment');

    }

}
