<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
	protected $fillable = ['phone_number'];

	const UPDATED_AT = null;

}
