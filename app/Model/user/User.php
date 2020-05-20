<?php

namespace App\Model\user;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    public function country()
    {
      return $this->belongsTo('App\Model\Country');
    }
    // public function appointment()
    // {
    //   return $this->hasMany('App\Model\client\Appointment');
    // }

    // public function country_id()
    // {
    //     return $this->belongsTo('App\Model\Country');
    // }

     // public function country_id(){
     //    return $this->hasMany('App\Model\Country','id', 'country_id');
     //   }

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
