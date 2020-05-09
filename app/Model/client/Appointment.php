<?php

namespace App\Model\client;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
   public function user() 
    {
        return $this->belongsTo('App\Model\user\User');
    }
    public function client() 
    {
        return $this->belongsTo('App\Model\client\Client');
    }
    public function appointment_slot()
    {
        return $this->belongsTo('App\Model\user\Appointment_slot');
    }
    public function service()
    {
        return $this->belongsTo('App\Model\user\Service');
    }
}
